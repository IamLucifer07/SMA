import sys
import json
import pandas as pd
from prophet import Prophet

def forecast(data):
    # Convert input data to DataFrame
    df = pd.DataFrame(data)
    df.columns = ['ds', 'y']

    # Create and fit the model
    model = Prophet()
    model.fit(df)

    # Create future dataframe for predictions
    future = model.make_future_dataframe(periods=365)

    # Make predictions
    forecast = model.predict(future)

    # Prepare results
    results = forecast[['ds', 'yhat', 'yhat_lower', 'yhat_upper']].tail(365).to_dict('records')

    return json.dumps(results)

if __name__ == '__main__':
    # Read input data from command line argument
    input_data = json.loads(sys.argv[1])
    
    # Run forecast and print results
    print(forecast(input_data))
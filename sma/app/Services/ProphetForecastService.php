namespace App\Services;

use Illuminate\Support\Facades\Log;

class ProphetForecastService
{
public function forecastEngagement(array $data, string $metric, int $periods = 30)
{
try {
// Your existing Python code
$df = pd.DataFrame({ 'ds': pd.to_datetime(data['date']),
'y': data[$metric]
});
$model = Prophet();
$model->fit($df);
$future = $model->make_future_dataframe(periods=$periods);
$forecast = $model->predict($future);

return $forecast[['ds', 'yhat', 'yhat_lower', 'yhat_upper']].tail(365)->to_dict('records');
} catch (\Exception $e) {
Log::error('Error in ProphetForecastService: ' . $e->getMessage());
return [];
}
}
}
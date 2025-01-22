<?php

namespace App\Services;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ProphetService
{
    public function forecast($data)
    {
        $pythonScript = base_path('app/Python/forecast.py');

        // Prepare data for Python script
        $jsonData = json_encode($data);

        // Run Python script
        $process = new Process(['python', $pythonScript, $jsonData]);
        $process->run();

        // Handle errors
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Get output
        $output = $process->getOutput();

        // Parse and return results
        return json_decode($output, true);
    }
}

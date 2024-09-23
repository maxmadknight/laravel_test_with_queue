<?php

namespace App\Jobs;

use App\Data\ProcessSubmissionData;
use App\Events\SubmissionSaved;
use App\Models\Submission;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ProcessSubmission implements ShouldQueue
{
    use Queueable;

    public ProcessSubmissionData $data;

    /**
     * Create a new job instance.
     */
    public function __construct(ProcessSubmissionData $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Save the submission, but better is to do it in service
            $submission = Submission::create($this->data->toArray());

            // Trigger the event after saving
            event(new SubmissionSaved($submission));

        } catch (QueryException|ValidationException|\Exception $e) {
            Log::error('Error saving submission: ' . $e->getMessage());
            throw $e;
        }
    }
}

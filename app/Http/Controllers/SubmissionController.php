<?php

namespace App\Http\Controllers;

use App\Data\ProcessSubmissionData;
use App\Jobs\ProcessSubmission;
use Illuminate\Http\JsonResponse;

class SubmissionController extends Controller
{
    public function submit(ProcessSubmissionData $data): JsonResponse
    {
        // Dispatch job to process the submission
        ProcessSubmission::dispatch($data);

        return response()->json(['success' => true, 'message' => 'Submission is being processed.']);
    }
}

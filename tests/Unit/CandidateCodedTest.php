<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\CandidateCoded;
use App\Jobs\PublishKafkaJob;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CandidateCodedTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testPublishToKafkaMethodCreatesTheCorrectObject()
    {
        Queue::fake();

        $candidateCoded = factory(CandidateCoded::class)->create();
        $expectedCandidateCodedObject = (object) [
            'type' => 'candidate-coded',
            'candidate-coded' => (object) [
                'id' => $candidateCoded->walter_coded_id,
                'user_id' => $candidateCoded->central_id,
                'created_at' => $candidateCoded->date->toISOString(),
            ]
        ];
        $candidateCoded->publishToKafka();

        Queue::assertPushed(PublishKafkaJob::class, function ($job) use ($expectedCandidateCodedObject) {
            if (json_encode($job->objectToPublish) == json_encode($expectedCandidateCodedObject)) {
                return true;
            } else {
                return false;
            }
        });
    }
}

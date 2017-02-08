<?php

namespace Tests\Feature;

use Tests\TestCase;

class HealthcheckTest extends TestCase
{
    /** @test */
    public function canPingHealthcheck()
    {
        $response = $this->get('/healthcheck/'.env('HEALTHCHECK_TOKEN'));

        $response->assertStatus(200);
    }
}

<?php

class HealthcheckTest extends TestCase
{
    /**
     * @test
     */
    public function canPingHealthcheck()
    {
        $this->get('/healthcheck/'.env('HEALTHCHECK_TOKEN'))
            ->assertResponseOk();
    }
}

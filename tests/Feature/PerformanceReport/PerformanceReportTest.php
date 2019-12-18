<?php

namespace Tests\Feature\PerformanceReport;

use App\Models\PerformanceReport\PerformanceReport;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PerformanceReportTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function last_report_group_by_campaign()
    {
        factory(PerformanceReport::class)->create([
            'campaign' => 'prezzogiusto_iren_sem',
            'cost' => 2,
            'is_last_daily' => true,
            'created_at' => '2019-12-03 00:00:00'
        ]);

        factory(PerformanceReport::class)->create([
            'campaign' => 'prezzogiusto_iren_display',
            'cost' => 3,
            'is_last_daily' => true,
            'created_at' => '2019-12-03 00:00:00'
        ]);

        factory(PerformanceReport::class)->create([
            'campaign' => 'prezzogiusto_iren_display',
            'cost' => 4,
            'is_last_daily' => true,
            'created_at' => '2019-12-04 00:00:00'
        ]);

        $response = $this->get('/api/performance-report?from=2019-12-03&to=2019-12-03&isLastDaily=true')
            ->assertStatus(200)
            ->assertJsonCount(2)
            ->assertJsonFragment([
                'campaign' => 'prezzogiusto_iren_display',
                'cost' => '3'
            ]);
    }

    /** @test */
    public function last_report_group_by_category_bing()
    {
        factory(PerformanceReport::class)->create([
            'campaign' => 'prezzogiusto_iren_sem',
            'cost' => 2,
            'category' => 'google',
            'is_last_daily' => true,
            'created_at' => '2019-12-03 00:00:00'
        ]);

        factory(PerformanceReport::class)->create([
            'campaign' => 'prezzogiusto_iren_display',
            'cost' => 3,
            'category' => 'bing',
            'is_last_daily' => true,
            'created_at' => '2019-12-03 00:00:00'
        ]);

        factory(PerformanceReport::class)->create([
            'campaign' => 'prezzogiusto_iren_display',
            'cost' => 4,
            'category' => 'google',
            'is_last_daily' => false,
            'created_at' => '2019-12-03 00:00:00'
        ]);

        $response = $this->get('/api/performance-report?category=bing&isLastDaily=true')
            ->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment([
                'campaign' => 'prezzogiusto_iren_display',
                'cost' => "3"
            ]);

    }

    /** @test */
    public function last_report_group_by_category_google()
    {
        factory(PerformanceReport::class)->create([
            'campaign' => 'prezzogiusto_iren_sem',
            'cost' => 2,
            'category' => 'bing',
            'is_last_daily' => true,
            'created_at' => '2019-12-03 00:00:00'
        ]);

        factory(PerformanceReport::class)->create([
            'campaign' => 'prezzogiusto_iren_display',
            'cost' => 3,
            'category' => 'google',
            'is_last_daily' => true,
            'created_at' => '2019-12-03 00:00:00'
        ]);

        factory(PerformanceReport::class)->create([
            'campaign' => 'prezzogiusto_iren_display',
            'cost' => 4,
            'category' => 'google',
            'is_last_daily' => true,
            'created_at' => '2019-12-03 00:00:00'
        ]);

        $response = $this->get('/api/performance-report?category=google')
            ->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment([
                'campaign' => 'prezzogiusto_iren_display',
                'cost' => "7"
            ]);

    }
}

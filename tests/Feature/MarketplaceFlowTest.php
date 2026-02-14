<?php

namespace Tests\Feature;

use App\Models\Campaign;
use App\Models\CampaignApplication;
use App\Models\Creator;
use App\Models\Promoter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MarketplaceFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_promoter_can_create_campaign(): void
    {
        $promoter = Promoter::create([
            'company_name' => 'Orbit Labs',
            'telegramusername' => 'orbitlabs',
            'telegramid' => '111',
            'company_description' => 'We ship dev tools.',
        ]);

        $response = $this->withSession(['promoter_id' => $promoter->id])->post(route('campaigns.store'), [
            'title' => 'Launch campaign for dev tool',
            'description' => 'Need creators to explain use cases.',
            'platforms' => 'youtube,tiktok',
            'niche' => 'tech',
            'budget' => 1500,
            'timeline' => now()->addDays(10)->toDateString(),
        ]);

        $campaign = Campaign::first();

        $response->assertRedirect(route('campaigns.show', $campaign));

        $this->assertDatabaseHas('campaigns', [
            'promoter_id' => $promoter->id,
            'title' => 'Launch campaign for dev tool',
            'niche' => 'tech',
        ]);
    }

    public function test_creator_can_apply_only_once_per_campaign(): void
    {
        $promoter = Promoter::create([
            'company_name' => 'Spark Ads',
        ]);

        $campaign = Campaign::create([
            'promoter_id' => $promoter->id,
            'title' => 'Mobile game campaign',
            'description' => 'UGC and short-form videos needed.',
            'platforms' => ['tiktok'],
            'niche' => 'gaming',
            'budget' => 600,
        ]);

        $creator = Creator::create([
            'display_name' => 'Mika Plays',
            'telegramusername' => 'mikaplays',
            'telegramid' => '222',
            'social_platforms' => ['tiktok:80k'],
            'niches' => ['gaming'],
        ]);

        $payload = [
            'pitch' => 'I can deliver two short videos with gameplay hooks and clear CTA for installs.',
            'links' => "https://tiktok.com/@mikaplays\nhttps://youtube.com/@mikaplays",
        ];

        $firstResponse = $this->withSession(['creator_id' => $creator->id])
            ->post(route('campaigns.apply.store', $campaign), $payload);

        $firstResponse->assertRedirect(route('creator.applications'));

        $secondResponse = $this->withSession(['creator_id' => $creator->id])
            ->post(route('campaigns.apply.store', $campaign), $payload);

        $secondResponse->assertRedirect(route('creator.applications'));

        $this->assertDatabaseCount('campaign_applications', 1);
        $this->assertDatabaseHas('campaign_applications', [
            'campaign_id' => $campaign->id,
            'creator_id' => $creator->id,
            'status' => 'pending',
        ]);
    }

    public function test_promoter_can_update_application_status_for_own_campaign(): void
    {
        $promoter = Promoter::create([
            'company_name' => 'Blue Horizon',
        ]);

        $campaign = Campaign::create([
            'promoter_id' => $promoter->id,
            'title' => 'Fintech awareness',
            'description' => 'Need explainers and platform walkthrough.',
        ]);

        $creator = Creator::create([
            'display_name' => 'Nia Creates',
        ]);

        $application = CampaignApplication::create([
            'campaign_id' => $campaign->id,
            'creator_id' => $creator->id,
            'pitch' => 'I have done similar fintech explainers with strong retention.',
            'status' => 'pending',
        ]);

        $response = $this->withSession(['promoter_id' => $promoter->id])
            ->patch(route('campaigns.applications.status', [$campaign, $application]), [
                'status' => 'accepted',
            ]);

        $response->assertRedirect(route('campaigns.applicants', $campaign));

        $this->assertDatabaseHas('campaign_applications', [
            'id' => $application->id,
            'status' => 'accepted',
        ]);
    }
}

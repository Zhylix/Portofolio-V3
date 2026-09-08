<?php

namespace App\Livewire;

use App\Models\Experience;
use App\Models\ExperienceType;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class JourneyTimeline extends Component
{
    public string $activeFilter = 'all';

    public bool $isPlaying = false;

    public int $currentIndex = 0;

    public function setFilter(string $filter): void
    {
        $this->activeFilter = $filter;
        $this->isPlaying = false;
        $this->currentIndex = 0;
    }

    public function togglePlay(): void
    {
        $this->isPlaying = ! $this->isPlaying;
    }

    public function nextMilestone(): void
    {
        $count = $this->getExperiencesCount();
        if ($count > 0) {
            $this->currentIndex = ($this->currentIndex + 1) % $count;
        }
    }

    public function prevMilestone(): void
    {
        $count = $this->getExperiencesCount();
        if ($count > 0) {
            $this->currentIndex = ($this->currentIndex - 1 + $count) % $count;
        }
    }

    public function stopPlay(): void
    {
        $this->isPlaying = false;
        $this->currentIndex = 0;
    }

    protected function getExperiencesQuery()
    {
        $query = Experience::with(['experienceType', 'organization', 'skills', 'projects', 'certificates', 'achievements', 'events'])
            ->whereHas('experienceType', fn ($q) => $q->where('is_active', true))
            ->published()
            ->visible()
            ->ordered();

        if ($this->activeFilter !== 'all') {
            $query->whereHas('experienceType', fn ($q) => $q->where('code', $this->activeFilter));
        }

        return $query;
    }

    protected function getExperiencesCount(): int
    {
        return $this->getExperiencesQuery()->count();
    }

    public function render(): View
    {
        $types = ExperienceType::active()->ordered()->get();
        $experiences = $this->getExperiencesQuery()->get();

        return view('livewire.journey-timeline', [
            'types' => $types,
            'experiences' => $experiences,
            'totalCount' => $experiences->count(),
        ]);
    }
}

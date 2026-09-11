<?php

namespace Database\Seeders;

use App\Enums\ContentStatus;
use App\Enums\ExperienceTypeEnum;
use App\Enums\ProjectStatus;
use App\Enums\VisibilityStatus;
use App\Models\Achievement;
use App\Models\Article;
use App\Models\Certificate;
use App\Models\Education;
use App\Models\Event;
use App\Models\Experience;
use App\Models\ExperienceType;
use App\Models\Organization;
use App\Models\Profile;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\SeoMetadata;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\SocialLink;
use App\Models\Technology;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User
        $user = User::updateOrCreate(
            ['email' => 'helmy@helmyyunan.dev'],
            [
                'name' => 'Helmy Yunan Nasution',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Profile
        $profile = Profile::updateOrCreate(
            ['email' => 'helmy@helmyyunan.dev'],
            [
                'name' => 'Helmy Yunan Nasution',
                'headline' => 'Software Engineer & System Architect specializing in High-Performance Laravel, Distributed Databases, and Clean Modular Architecture.',
                'short_bio' => 'Engineering robust backend systems, resilient API architectures, and enterprise platforms with deep focus on reliability, scalability, and code cleanliness.',
                'long_bio' => "Helmy Yunan Nasution is a seasoned Software Engineer and System Architect with extensive hands-on experience designing and operating mission-critical applications.\n\nOver the course of his professional trajectory, Helmy has led architectural overhauls for enterprise systems, engineered high-throughput transactional backends, mentored engineering cohorts, and contributed actively to open-source and developer ecosystems.\n\nHis technical philosophy revolves around Domain-Driven Design (DDD), idiomatic Eloquent ORM modeling, database query optimization, and creating interfaces that remain delightful, clean, and intuitive.",
                'location' => 'Jakarta / Remote, Indonesia',
                'avatar' => null,
                'resume' => '/assets/docs/Helmy_Yunan_Nasution_Resume.pdf',
                'availability' => 'Open to Enterprise Architecture Consulting & Strategic Tech Roles',
                'hero_label' => 'Software Engineer & System Architect',
                'hero_description' => 'Architecting resilient backend platforms, database infrastructures, and enterprise software systems.',
            ]
        );

        // 3. Experience Types
        $experienceTypesData = [
            ExperienceTypeEnum::WORK->value => ['name' => 'Work Experience', 'icon' => 'briefcase', 'sort' => 1],
            ExperienceTypeEnum::INTERNSHIP->value => ['name' => 'Internship', 'icon' => 'academic-cap', 'sort' => 2],
            ExperienceTypeEnum::FREELANCE->value => ['name' => 'Freelance & Contract', 'icon' => 'laptop', 'sort' => 3],
            ExperienceTypeEnum::CLIENT_PROJECT->value => ['name' => 'Client Project', 'icon' => 'user-group', 'sort' => 4],
            ExperienceTypeEnum::PERSONAL_PROJECT->value => ['name' => 'Personal Project', 'icon' => 'code-bracket', 'sort' => 5],
            ExperienceTypeEnum::SCHOOL_PROJECT->value => ['name' => 'School & Academic Project', 'icon' => 'book-open', 'sort' => 6],
            ExperienceTypeEnum::ORGANIZATION->value => ['name' => 'Organization', 'icon' => 'building-office', 'sort' => 7],
            ExperienceTypeEnum::LEADERSHIP->value => ['name' => 'Leadership & Governance', 'icon' => 'flag', 'sort' => 8],
            ExperienceTypeEnum::VOLUNTEER->value => ['name' => 'Volunteer Service', 'icon' => 'heart', 'sort' => 9],
            ExperienceTypeEnum::COMPETITION->value => ['name' => 'Competition', 'icon' => 'trophy', 'sort' => 10],
            ExperienceTypeEnum::HACKATHON->value => ['name' => 'Hackathon', 'icon' => 'sparkles', 'sort' => 11],
            ExperienceTypeEnum::TRAINING->value => ['name' => 'Training & Bootcamp', 'icon' => 'identification', 'sort' => 12],
            ExperienceTypeEnum::CERTIFICATION->value => ['name' => 'Certification Program', 'icon' => 'shield-check', 'sort' => 13],
            ExperienceTypeEnum::RESEARCH->value => ['name' => 'Research & Publications', 'icon' => 'document-magnifying-glass', 'sort' => 14],
            ExperienceTypeEnum::OPEN_SOURCE->value => ['name' => 'Open Source Contribution', 'icon' => 'globe-alt', 'sort' => 15],
            ExperienceTypeEnum::EVENT->value => ['name' => 'Event & Conference', 'icon' => 'calendar', 'sort' => 16],
            ExperienceTypeEnum::SPEAKING->value => ['name' => 'Technical Speaking & Keynotes', 'icon' => 'microphone', 'sort' => 17],
            ExperienceTypeEnum::MENTORING->value => ['name' => 'Mentoring & Education', 'icon' => 'users', 'sort' => 18],
            ExperienceTypeEnum::COMMUNITY->value => ['name' => 'Community Building', 'icon' => 'chat-bubble-left-right', 'sort' => 19],
            ExperienceTypeEnum::OTHER->value => ['name' => 'Other Experience', 'icon' => 'ellipsis-horizontal', 'sort' => 20],
        ];

        $experienceTypes = [];
        foreach ($experienceTypesData as $code => $data) {
            $experienceTypes[$code] = ExperienceType::updateOrCreate(
                ['code' => $code],
                [
                    'name' => $data['name'],
                    'description' => 'Experiences and milestones categorized under '.$data['name'],
                    'icon' => $data['icon'],
                    'is_active' => true,
                    'sort_order' => $data['sort'],
                ]
            );
        }

        // 4. Organizations
        $orgTechCorp = Organization::updateOrCreate(
            ['slug' => 'nusa-tech-innovations'],
            [
                'name' => 'Nusa Tech Innovations',
                'description' => 'Leading enterprise cloud and SaaS solutions provider across Southeast Asia.',
                'website' => 'https://nusatech.example.com',
                'location' => 'Jakarta, Indonesia',
            ]
        );

        $orgDevStudio = Organization::updateOrCreate(
            ['slug' => 'archipel-software-labs'],
            [
                'name' => 'Archipel Software Labs',
                'description' => 'Boutique digital product studio engineering custom high-scale platforms.',
                'website' => 'https://archipel.example.com',
                'location' => 'Bandung, Indonesia',
            ]
        );

        $orgOpenCollective = Organization::updateOrCreate(
            ['slug' => 'indonesia-laravel-community'],
            [
                'name' => 'Indonesia Laravel Community',
                'description' => 'National community of PHP and Laravel practitioners and open-source creators.',
                'website' => 'https://laravel.or.id',
                'location' => 'Indonesia',
            ]
        );

        // 5. Technologies (8+)
        $techLaravel = Technology::updateOrCreate(['slug' => 'laravel-13'], [
            'name' => 'Laravel 13',
            'description' => 'Modern PHP web artisan framework with state of the art expressive syntax.',
            'website' => 'https://laravel.com',
            'sort_order' => 1,
        ]);

        $techPHP = Technology::updateOrCreate(['slug' => 'php-8-4'], [
            'name' => 'PHP 8.4',
            'description' => 'High performance typed server language powering modern web applications.',
            'website' => 'https://php.net',
            'sort_order' => 2,
        ]);

        $techMySQL = Technology::updateOrCreate(['slug' => 'mysql-mariadb'], [
            'name' => 'MySQL / MariaDB',
            'description' => 'ACID compliant relational database engine configured for high concurrency.',
            'website' => 'https://www.mysql.com',
            'sort_order' => 3,
        ]);

        $techTailwind = Technology::updateOrCreate(['slug' => 'tailwind-css-4'], [
            'name' => 'Tailwind CSS 4',
            'description' => 'Next generation utility-first CSS framework with native lightning engine.',
            'website' => 'https://tailwindcss.com',
            'sort_order' => 4,
        ]);

        $techLivewire = Technology::updateOrCreate(['slug' => 'livewire-4'], [
            'name' => 'Livewire 4',
            'description' => 'Full-stack framework for Laravel enabling dynamic reactive interfaces.',
            'website' => 'https://livewire.laravel.com',
            'sort_order' => 5,
        ]);

        $techAlpine = Technology::updateOrCreate(['slug' => 'alpine-js'], [
            'name' => 'Alpine.js',
            'description' => 'Rugged, minimal client-side interactivity directly inside markup.',
            'website' => 'https://alpinejs.dev',
            'sort_order' => 6,
        ]);

        $techDocker = Technology::updateOrCreate(['slug' => 'docker'], [
            'name' => 'Docker',
            'description' => 'Containerized environments for consistent development and staging setups.',
            'website' => 'https://www.docker.com',
            'sort_order' => 7,
        ]);

        $techRedis = Technology::updateOrCreate(['slug' => 'redis'], [
            'name' => 'Redis',
            'description' => 'In-memory key-value data store used for cache layers and asynchronous queues.',
            'website' => 'https://redis.io',
            'sort_order' => 8,
        ]);

        // 6. Skill Categories & Skills (10+)
        $catBackend = SkillCategory::updateOrCreate(['slug' => 'backend-architecture'], [
            'name' => 'Backend & Architecture',
            'description' => 'Core server-side engineering, design patterns, and system reliability.',
            'sort_order' => 1,
        ]);

        $catDatabase = SkillCategory::updateOrCreate(['slug' => 'database-data-design'], [
            'name' => 'Databases & Performance',
            'description' => 'Relational schemas, query optimization, indexing, and data pipelines.',
            'sort_order' => 2,
        ]);

        $catFrontend = SkillCategory::updateOrCreate(['slug' => 'frontend-ui-engineering'], [
            'name' => 'Frontend & Interaction',
            'description' => 'Responsive design, reactive components, and accessible interfaces.',
            'sort_order' => 3,
        ]);

        $catDevOps = SkillCategory::updateOrCreate(['slug' => 'devops-infrastructure'], [
            'name' => 'DevOps & Tooling',
            'description' => 'Deployment automation, containerization, and workflow tooling.',
            'sort_order' => 4,
        ]);

        $skillLaravel = Skill::updateOrCreate(['slug' => 'laravel-framework'], [
            'skill_category_id' => $catBackend->id,
            'name' => 'Laravel Framework Architecture',
            'description' => 'Architecting scalable applications with Service Layers, Form Requests, and Eloquent Scopes.',
            'featured' => true,
            'sort_order' => 1,
        ]);

        $skillPHP = Skill::updateOrCreate(['slug' => 'modern-php'], [
            'skill_category_id' => $catBackend->id,
            'name' => 'Modern PHP (8.4+)',
            'description' => 'Strict types, Property Promotion, Enums, Match Expressions, and Clean Code.',
            'featured' => true,
            'sort_order' => 2,
        ]);

        $skillDDD = Skill::updateOrCreate(['slug' => 'system-design-ddd'], [
            'skill_category_id' => $catBackend->id,
            'name' => 'System Design & DDD',
            'description' => 'Domain-Driven Design, Event-Driven Architecture, and Microservice-Ready Monoliths.',
            'featured' => true,
            'sort_order' => 3,
        ]);

        $skillMySQL = Skill::updateOrCreate(['slug' => 'mysql-performance-tuning'], [
            'skill_category_id' => $catDatabase->id,
            'name' => 'MySQL Optimization & Indexing',
            'description' => 'Schema normalization, composite indexing strategies, and EXPLAIN query plan profiling.',
            'featured' => true,
            'sort_order' => 4,
        ]);

        $skillRedis = Skill::updateOrCreate(['slug' => 'redis-caching-queues'], [
            'skill_category_id' => $catDatabase->id,
            'name' => 'Redis Caching & Queues',
            'description' => 'Atomic locking, cache eviction policies, and queue orchestration.',
            'featured' => false,
            'sort_order' => 5,
        ]);

        $skillTailwind = Skill::updateOrCreate(['slug' => 'tailwind-css'], [
            'skill_category_id' => $catFrontend->id,
            'name' => 'Tailwind CSS & Design Systems',
            'description' => 'Crafting sleek bespoke components, fluid typography, and dark mode UI.',
            'featured' => true,
            'sort_order' => 6,
        ]);

        $skillLivewire = Skill::updateOrCreate(['slug' => 'livewire-fullstack'], [
            'skill_category_id' => $catFrontend->id,
            'name' => 'Livewire & Alpine.js',
            'description' => 'Dynamic reactive server-rendered user interfaces without SPA overhead.',
            'featured' => true,
            'sort_order' => 7,
        ]);

        $skillDocker = Skill::updateOrCreate(['slug' => 'docker-containerization'], [
            'skill_category_id' => $catDevOps->id,
            'name' => 'Docker & Environment Scaffolding',
            'description' => 'Multi-stage Docker builds, development environments, and microservice orchestration.',
            'featured' => false,
            'sort_order' => 8,
        ]);

        // 7. Project Categories
        $catEnterprise = ProjectCategory::updateOrCreate(['slug' => 'enterprise-systems'], [
            'name' => 'Enterprise Platforms',
            'description' => 'Multi-tenant ERP, HRIS, and mission-critical corporate applications.',
            'sort_order' => 1,
        ]);

        $catWebApps = ProjectCategory::updateOrCreate(['slug' => 'saas-web-applications'], [
            'name' => 'SaaS & Web Applications',
            'description' => 'High-throughput consumer and commercial cloud applications.',
            'sort_order' => 2,
        ]);

        $catOpenSource = ProjectCategory::updateOrCreate(['slug' => 'developer-tools'], [
            'name' => 'Developer Tooling & OSS',
            'description' => 'Developer utilities, CLI packages, and open source frameworks.',
            'sort_order' => 3,
        ]);

        // 8. Projects (6 Realistic Systems)
        $projHRIS = Project::updateOrCreate(['slug' => 'nusa-hris-enterprise-suite'], [
            'category_id' => $catEnterprise->id,
            'title' => 'Nusa HRIS & Multi-Tenant Payroll Platform',
            'short_description' => 'Enterprise Human Resource Information System processing automated attendance, complex tax calculations, and payroll workflows for 10,000+ employees.',
            'description' => "Architected and built an enterprise multi-tenant HRIS supporting automated payroll computation (PPH21 compliant), multi-tier organizational approval chains, biometric attendance synchronization, and audit logging.\n\nDesigned isolated tenant schemas and caching structures to handle concurrent month-end payroll calculation runs without degrading user experience.",
            'problem' => 'Legacy payroll execution took over 45 minutes for 10,000 employees, causing timeout errors and manual spreadsheet reconciliations.',
            'solution' => 'Implemented chunked Redis queue jobs with database transactions and batch notification workers, dropping payroll processing runtime to 90 seconds.',
            'features' => ['Multi-tenant organization isolation', 'Asynchronous payroll calculation engine', 'Complex tax & deductions matrix', 'Role-based permission hierarchy', 'Exportable encrypted bank payroll vouchers'],
            'architecture' => 'Laravel Modular Monolith with Domain-Driven Service layers, Redis queues, and MariaDB relational schema.',
            'role' => 'Lead System Architect & Backend Developer',
            'started_at' => Carbon::parse('2023-01-15'),
            'ended_at' => Carbon::parse('2023-11-30'),
            'status' => ProjectStatus::COMPLETED->value,
            'github_url' => 'https://github.com/helmyyunan/nusa-hris',
            'demo_url' => 'https://hris.example.com',
            'featured' => true,
            'sort_order' => 1,
        ]);

        $projLogistics = Project::updateOrCreate(['slug' => 'logistix-freight-tracking-engine'], [
            'category_id' => $catEnterprise->id,
            'title' => 'Logistix Real-Time Freight & Fleet Orchestrator',
            'short_description' => 'Inter-island shipment tracking platform with IoT telematics ingestion, automated dispatch routing, and digital bill of lading management.',
            'description' => "Developed an end-to-end logistics platform that connects nationwide cargo ships, trucking fleets, and regional hub warehouses.\n\nFeatures GPS waypoint tracking, webhook integrations with third-party logistics carriers, and dynamic invoice generation.",
            'problem' => 'Manual dispatch errors and delayed cargo status notifications led to customer churn and lack of milestone visibility.',
            'solution' => 'Created an automated event-driven state machine managing shipping lifecycles with real-time customer status broadcasts.',
            'features' => ['Telematics ingestion pipeline', 'Dynamic delivery route optimization', 'Digital signature proof-of-delivery', 'Real-time customer tracking portal'],
            'architecture' => 'Event-Driven Laravel with WebSockets, Redis cache layer, and MySQL spatial indexes.',
            'role' => 'Backend Architect',
            'started_at' => Carbon::parse('2023-08-01'),
            'ended_at' => Carbon::parse('2024-04-15'),
            'status' => ProjectStatus::COMPLETED->value,
            'github_url' => 'https://github.com/helmyyunan/logistix-engine',
            'demo_url' => 'https://logistix.example.com',
            'featured' => true,
            'sort_order' => 2,
        ]);

        $projJourney = Project::updateOrCreate(['slug' => 'helmy-journey-system'], [
            'category_id' => $catWebApps->id,
            'title' => 'Helmy Yunan Nasution — Personal Information & Journey System',
            'short_description' => 'Comprehensive dynamic information architecture modeling professional trajectory, empirical skill evidence, and portfolio case studies.',
            'description' => "Engineered a database-driven personal journey and knowledge portal built on Laravel 13, MySQL, Livewire 4, and Tailwind CSS 4.\n\nReplaces traditional static CVs with an empirical evidence system linking skills to verified projects, certificates, and professional milestones.",
            'problem' => 'Static portfolio sites become obsolete quickly and fail to capture the multi-dimensional nature of modern software engineering experience.',
            'solution' => 'Constructed a normalized relational schema with 20 experience types, bi-directional pivots, and modular query services.',
            'features' => ['20 distinct experience types', 'Empirical skill evidence counts', 'Polymorphic SEO metadata', 'Full-text search engine', 'Responsive Tailwind CSS 4 UI'],
            'architecture' => 'Laravel 13 Clean Architecture with Eloquent Relational Mapping, Livewire 4, and Alpine.js.',
            'role' => 'Full-Stack Architect & Creator',
            'started_at' => Carbon::parse('2024-01-10'),
            'ended_at' => null,
            'status' => ProjectStatus::MAINTAINED->value,
            'github_url' => 'https://github.com/helmyyunan/portoa1',
            'demo_url' => 'https://helmyyunan.dev',
            'featured' => true,
            'sort_order' => 3,
        ]);

        $projAnalytics = Project::updateOrCreate(['slug' => 'pulse-micro-saas-analytics'], [
            'category_id' => $catWebApps->id,
            'title' => 'PulseMetrics — Privacy-Centric Analytics Engine',
            'short_description' => 'Lightweight cookieless website analytics service designed to process millions of pageview events with sub-millisecond write latency.',
            'description' => "Engineered a privacy-respecting analytics platform providing real-time visitor counts, referrer insights, and geographical distributions without tracking personal data.\n\nBuilt with an ultra-lightweight JavaScript tracking beacon and high-speed ingest buffering.",
            'problem' => 'Traditional analytics tools load heavy tracking scripts, violate user privacy regulations, and slow down page rendering.',
            'solution' => 'Designed a sub-2KB tracking beacon with server-side aggregation pipelines reducing database write load by 85%.',
            'features' => ['Cookie-free visitor hashing', 'Real-time active visitor stream', 'Referrer breakdown graphs', 'Daily digest email reports'],
            'architecture' => 'Laravel API endpoints, Redis buffer for write smoothing, and optimized MariaDB aggregations.',
            'role' => 'Sole Engineer',
            'started_at' => Carbon::parse('2024-03-01'),
            'ended_at' => Carbon::parse('2024-08-20'),
            'status' => ProjectStatus::COMPLETED->value,
            'github_url' => 'https://github.com/helmyyunan/pulse-metrics',
            'demo_url' => 'https://pulse.example.com',
            'featured' => false,
            'sort_order' => 4,
        ]);

        $projPayOrchestrator = Project::updateOrCreate(['slug' => 'gateway-orchestrator'], [
            'category_id' => $catEnterprise->id,
            'title' => 'OmniPay Payment Gateway Orchestrator',
            'short_description' => 'Unified multi-provider payment switch with automatic fallback, idempotency controls, and automated settlement reconciliation.',
            'description' => "Engineered a financial middleware connecting e-commerce platforms to multiple payment aggregators (Virtual Accounts, QRIS, e-Wallets, Cards).\n\nGuarantees exactly-once processing using database locks and HMAC signature verification.",
            'problem' => 'Payment gateway downtime caused checkout drops and reconciliation mismatches between merchant books and gateway statements.',
            'solution' => 'Implemented automated gateway health checks with smart failover routing and automated CSV reconciliation jobs.',
            'features' => ['Zero-downtime provider fallback', 'Idempotent webhook processing', 'Automated reconciliation reports', 'Encrypted transaction ledger'],
            'architecture' => 'Micro-service orchestration architecture with Laravel, Redis locking, and encrypted audit tables.',
            'role' => 'Senior Backend Engineer',
            'started_at' => Carbon::parse('2023-05-10'),
            'ended_at' => Carbon::parse('2024-02-15'),
            'status' => ProjectStatus::COMPLETED->value,
            'github_url' => 'https://github.com/helmyyunan/omnipay-switch',
            'demo_url' => null,
            'featured' => true,
            'sort_order' => 5,
        ]);

        $projCLI = Project::updateOrCreate(['slug' => 'artisan-pack-generator-cli'], [
            'category_id' => $catOpenSource->id,
            'title' => 'Laravel CraftOps CLI Developer Tool',
            'short_description' => 'Open source command-line tool for scaffolding clean architectural boilerplates, service classes, and contract interfaces in Laravel projects.',
            'description' => "Developed an open-source developer productivity tool used by over 500+ developers to scaffold clean architectural patterns in Laravel projects.\n\nAutomates generation of Services, Repositories, DTOs, Enums, and custom test stubs.",
            'problem' => 'Developers repetitively write boilerplate code for service layers, form requests, and contracts without standard structure.',
            'solution' => 'Created an interactive CLI with rich terminal prompts and custom stub templates matching PSR and Laravel conventions.',
            'features' => ['Interactive schema builder', 'Customizable stub templates', 'Automated test generation', 'Strict type hinting enforcement'],
            'architecture' => 'PHP CLI package utilizing Symfony Console and Laravel Prompts.',
            'role' => 'Creator & Maintainer',
            'started_at' => Carbon::parse('2024-02-01'),
            'ended_at' => null,
            'status' => ProjectStatus::MAINTAINED->value,
            'github_url' => 'https://github.com/helmyyunan/craftops-cli',
            'demo_url' => 'https://packagist.org/packages/helmyyunan/craftops-cli',
            'featured' => false,
            'sort_order' => 6,
        ]);

        // Attach Technologies to Projects
        $projHRIS->technologies()->sync([$techLaravel->id, $techPHP->id, $techMySQL->id, $techRedis->id, $techDocker->id]);
        $projLogistics->technologies()->sync([$techLaravel->id, $techPHP->id, $techMySQL->id, $techRedis->id]);
        $projJourney->technologies()->sync([$techLaravel->id, $techPHP->id, $techMySQL->id, $techTailwind->id, $techLivewire->id, $techAlpine->id]);
        $projAnalytics->technologies()->sync([$techPHP->id, $techLaravel->id, $techMySQL->id, $techRedis->id]);
        $projPayOrchestrator->technologies()->sync([$techLaravel->id, $techPHP->id, $techMySQL->id, $techRedis->id, $techDocker->id]);
        $projCLI->technologies()->sync([$techPHP->id, $techLaravel->id]);

        // Attach Skills to Projects
        $projHRIS->skills()->sync([$skillLaravel->id, $skillPHP->id, $skillMySQL->id, $skillDDD->id]);
        $projLogistics->skills()->sync([$skillLaravel->id, $skillPHP->id, $skillMySQL->id]);
        $projJourney->skills()->sync([$skillLaravel->id, $skillPHP->id, $skillTailwind->id, $skillLivewire->id, $skillMySQL->id]);
        $projAnalytics->skills()->sync([$skillPHP->id, $skillMySQL->id, $skillRedis->id]);
        $projPayOrchestrator->skills()->sync([$skillLaravel->id, $skillPHP->id, $skillDDD->id, $skillRedis->id]);
        $projCLI->skills()->sync([$skillPHP->id, $skillLaravel->id]);

        // 9. Events (3)
        $eventSummit = Event::updateOrCreate(['slug' => 'southeast-asia-php-conference-2024'], [
            'name' => 'Southeast Asia PHP & Architecture Summit 2024',
            'type' => 'Conference',
            'organizer' => 'PHP Developers Collective',
            'description' => 'Regional gathering of software architects and backend specialists discussing high concurrency and performance.',
            'date' => Carbon::parse('2024-05-18'),
            'location' => 'Singapore / Hybrid',
            'url' => 'https://seaphp.example.com',
        ]);

        $eventHackathon = Event::updateOrCreate(['slug' => 'national-fintech-hackathon-2023'], [
            'name' => 'National FinTech Innovation Hackathon 2023',
            'type' => 'Hackathon',
            'organizer' => 'FinTech Association Indonesia',
            'description' => '48-hour competitive engineering hackathon building resilient banking and payment prototypes.',
            'date' => Carbon::parse('2023-10-14'),
            'location' => 'Jakarta, Indonesia',
            'url' => 'https://fintechhackathon.example.com',
        ]);

        $eventMeetup = Event::updateOrCreate(['slug' => 'jakarta-laravel-meetup-deep-dive'], [
            'name' => 'Jakarta Laravel Meetup: Eloquent & Query Optimization',
            'type' => 'Speaking',
            'organizer' => 'Indonesia Laravel Community',
            'description' => 'Technical meetup delivering live deep-dives into database indexing strategies and memory profiling in Laravel.',
            'date' => Carbon::parse('2024-02-24'),
            'location' => 'Jakarta, Indonesia',
            'url' => 'https://meetup.example.com/jakarta-laravel',
        ]);

        // 10. Achievements (3)
        $achHackathon = Achievement::updateOrCreate(['slug' => '1st-place-fintech-hackathon'], [
            'title' => '1st Place Champion — National FinTech Hackathon',
            'description' => 'Won 1st Place out of 120 national engineering teams for developing OmniPay, an automated failover payment orchestrator.',
            'organization' => 'FinTech Association Indonesia',
            'date' => Carbon::parse('2023-10-15'),
            'rank' => '1st Place Winner',
            'result' => 'Gold Trophy & Innovation Grant',
            'url' => 'https://fintechhackathon.example.com/winners/2023',
            'featured' => true,
            'sort_order' => 1,
        ]);

        $achBestArch = Achievement::updateOrCreate(['slug' => 'best-enterprise-architecture-award'], [
            'title' => 'Best Engineering Architecture Award 2023',
            'description' => 'Awarded for exceptional architectural design and optimization of Nusa HRIS multi-tenant database engine.',
            'organization' => 'Nusa Tech Innovations',
            'date' => Carbon::parse('2023-12-20'),
            'rank' => 'Annual Excellence Award',
            'result' => 'Honored at Annual Tech Gala',
            'url' => null,
            'featured' => true,
            'sort_order' => 2,
        ]);

        $achDeansList = Achievement::updateOrCreate(['slug' => 'academic-valedictorian-honor'], [
            'title' => 'Top Graduate & Outstanding Academic Achievement',
            'description' => 'Graduated with highest GPA in Faculty of Informatics & Computer Science.',
            'organization' => 'Faculty of Informatics',
            'date' => Carbon::parse('2022-08-20'),
            'rank' => 'Valedictorian',
            'result' => 'Summa Cum Laude (GPA 3.94/4.00)',
            'url' => null,
            'featured' => false,
            'sort_order' => 3,
        ]);

        $achHackathon->skills()->sync([$skillLaravel->id, $skillPHP->id, $skillDDD->id]);
        $achBestArch->skills()->sync([$skillLaravel->id, $skillMySQL->id, $skillDDD->id]);
        $achHackathon->projects()->sync([$projPayOrchestrator->id]);
        $achBestArch->projects()->sync([$projHRIS->id]);

        // 11. Certificates (3)
        $certAWS = Certificate::updateOrCreate(['slug' => 'aws-certified-solutions-architect'], [
            'title' => 'AWS Certified Solutions Architect – Associate',
            'issuer' => 'Amazon Web Services (AWS)',
            'credential_id' => 'AWS-SAA-884920491',
            'description' => 'Demonstrated comprehensive capability to design resilient, high-performing, secure, and cost-optimized cloud architectures.',
            'issued_at' => Carbon::parse('2023-04-10'),
            'expires_at' => Carbon::parse('2026-04-10'),
            'credential_url' => 'https://aws.amazon.com/verification/AWS-SAA-884920491',
            'featured' => true,
            'sort_order' => 1,
        ]);

        $certLaravel = Certificate::updateOrCreate(['slug' => 'laravel-certified-developer'], [
            'title' => 'Laravel Certified Developer',
            'issuer' => 'Laravel LLC',
            'credential_id' => 'LCE-2023-0941',
            'description' => 'Official certification demonstrating thorough mastery of Laravel core, testing, architecture, security, and Eloquent ORM.',
            'issued_at' => Carbon::parse('2023-09-05'),
            'expires_at' => null,
            'credential_url' => 'https://certification.laravel.com/verify/LCE-2023-0941',
            'featured' => true,
            'sort_order' => 2,
        ]);

        $certMySQL = Certificate::updateOrCreate(['slug' => 'oracle-mysql-database-developer'], [
            'title' => 'MySQL Database Developer Certified Professional',
            'issuer' => 'Oracle Corporation',
            'credential_id' => 'OCP-MYSQL-9321',
            'description' => 'Demonstrated proficiency in SQL programming, query plan optimization, schema design, and transactional safety.',
            'issued_at' => Carbon::parse('2022-11-15'),
            'expires_at' => null,
            'credential_url' => 'https://oracle.com/verify/OCP-MYSQL-9321',
            'featured' => true,
            'sort_order' => 3,
        ]);

        $certAWS->skills()->sync([$skillDocker->id, $skillDDD->id]);
        $certLaravel->skills()->sync([$skillLaravel->id, $skillPHP->id]);
        $certMySQL->skills()->sync([$skillMySQL->id]);

        // 12. Educations (2)
        Education::updateOrCreate(['slug' => 'bachelor-computer-science'], [
            'institution' => 'State University of Informatics',
            'degree' => 'Bachelor of Computer Science (S.Kom)',
            'major' => 'Software Engineering & Distributed Systems',
            'description' => 'Focused on distributed database systems, algorithms, compiler design, and software engineering methodologies. Graduated with Honors.',
            'started_at' => Carbon::parse('2018-09-01'),
            'ended_at' => Carbon::parse('2022-08-15'),
            'is_current' => false,
            'sort_order' => 1,
        ]);

        Education::updateOrCreate(['slug' => 'vocational-software-engineering'], [
            'institution' => 'Vocational Technical Academy',
            'degree' => 'Diploma in Informatics Engineering',
            'major' => 'Web & Computer Programming',
            'description' => 'Extensive practical foundation in algorithm design, object-oriented programming, and relational database management.',
            'started_at' => Carbon::parse('2015-07-01'),
            'ended_at' => Carbon::parse('2018-06-30'),
            'is_current' => false,
            'sort_order' => 2,
        ]);

        // 13. Experiences (6+ across several types)
        $expWork = Experience::updateOrCreate(['slug' => 'lead-backend-architect-nusa-tech'], [
            'experience_type_id' => $experienceTypes[ExperienceTypeEnum::WORK->value]->id,
            'organization_id' => $orgTechCorp->id,
            'title' => 'Lead Backend Engineer & System Architect',
            'role' => 'Lead Backend Architect',
            'summary' => 'Directing core platform architecture, database indexing strategies, and high-throughput microservices across multiple product squads.',
            'description' => "Led the technical architecture of enterprise SaaS products serving hundreds of corporate clients.\n\nSpearheaded database schema refactoring, formulated technical standards across the engineering department, and established automated CI/CD code quality gates with PHPStan and Pint.",
            'contribution' => 'Re-architected the multi-tenant payroll engine, reducing runtime from 45 minutes to 90 seconds and eliminating database lock contention.',
            'challenge' => 'Massive database lock contention during concurrent month-end batch processing with millions of records.',
            'solution' => 'Introduced asynchronous queue chunking, partitioned index tables, and optimistic locking mechanisms.',
            'outcome' => 'Zero downtime across 18 consecutive payroll release cycles and 95% reduction in customer-reported support tickets.',
            'location' => 'Jakarta, Indonesia (Hybrid)',
            'started_at' => Carbon::parse('2023-01-01'),
            'ended_at' => null,
            'is_current' => true,
            'featured' => true,
            'status' => ContentStatus::PUBLISHED->value,
            'sort_order' => 1,
            'visibility' => VisibilityStatus::PUBLIC->value,
        ]);

        $expFreelance = Experience::updateOrCreate(['slug' => 'senior-software-consultant-archipel'], [
            'experience_type_id' => $experienceTypes[ExperienceTypeEnum::FREELANCE->value]->id,
            'organization_id' => $orgDevStudio->id,
            'title' => 'Senior Architecture Consultant & Full-Stack Engineer',
            'role' => 'Principal Technical Consultant',
            'summary' => 'Delivering architectural audits, performance tuning, and technical guidance for high-growth tech startups.',
            'description' => "Consulted with founding teams to design scalable backend architectures on Laravel and MySQL.\n\nAudited database performance, conducted code reviews, and implemented resilient payment integrations.",
            'contribution' => 'Engineered OmniPay switch prototype and guided development team in Domain-Driven Design principles.',
            'challenge' => 'Client applications suffered from catastrophic N+1 query cascades under high traffic spikes.',
            'solution' => 'Conducted comprehensive query profiling, established eager loading conventions, and integrated Redis caching layers.',
            'outcome' => 'Average API latency reduced by 72%, allowing client platforms to handle 10x traffic increase without upgrading server tier.',
            'location' => 'Remote',
            'started_at' => Carbon::parse('2022-09-01'),
            'ended_at' => Carbon::parse('2023-12-31'),
            'is_current' => false,
            'featured' => true,
            'status' => ContentStatus::PUBLISHED->value,
            'sort_order' => 2,
            'visibility' => VisibilityStatus::PUBLIC->value,
        ]);

        $expHackathon = Experience::updateOrCreate(['slug' => 'fintech-hackathon-team-lead'], [
            'experience_type_id' => $experienceTypes[ExperienceTypeEnum::HACKATHON->value]->id,
            'organization_id' => null,
            'title' => '1st Place Team Lead — National FinTech Hackathon',
            'role' => 'Team Lead & Lead Developer',
            'summary' => 'Conceptualized, architected, and built an automated payment failover routing system during a 48-hour national hackathon.',
            'description' => 'Led a multidisciplinary squad of 4 developers and designers through rapid prototyping of a payment orchestration switch.',
            'contribution' => 'Architected the core state machine, webhook verification engine, and live simulation demo.',
            'challenge' => 'Building a fault-tolerant banking prototype with multi-provider simulated failover within 48 hours.',
            'solution' => 'Utilized Laravel queued events, atomic database locks, and Livewire for real-time interactive monitoring.',
            'outcome' => 'Awarded 1st Place Champion out of 120 competitive submissions nationwide.',
            'location' => 'Jakarta, Indonesia',
            'started_at' => Carbon::parse('2023-10-13'),
            'ended_at' => Carbon::parse('2023-10-15'),
            'is_current' => false,
            'featured' => true,
            'status' => ContentStatus::PUBLISHED->value,
            'sort_order' => 3,
            'visibility' => VisibilityStatus::PUBLIC->value,
        ]);

        $expSpeaking = Experience::updateOrCreate(['slug' => 'tech-speaker-jakarta-laravel'], [
            'experience_type_id' => $experienceTypes[ExperienceTypeEnum::SPEAKING->value]->id,
            'organization_id' => $orgOpenCollective->id,
            'title' => 'Keynote Speaker: Mastering Eloquent & Query Optimization',
            'role' => 'Guest Technical Speaker',
            'summary' => 'Delivered an in-depth workshop on database indexing, EXPLAIN plans, and performance tuning in Laravel applications.',
            'description' => 'Presented live coding demonstrations showing real-world profiling techniques, composite index tradeoffs, and caching patterns to an audience of 150+ engineers.',
            'contribution' => 'Prepared benchmark test suites and open-sourced repository materials for community reference.',
            'challenge' => 'Making complex database internal mechanics accessible and immediately actionable for mid-level engineers.',
            'solution' => 'Used live visual EXPLAIN query demonstrations comparing unindexed vs composite-indexed queries.',
            'outcome' => 'Ranked #1 highest-rated session in community post-event survey with 98% positive feedback.',
            'location' => 'Jakarta, Indonesia',
            'started_at' => Carbon::parse('2024-02-24'),
            'ended_at' => Carbon::parse('2024-02-24'),
            'is_current' => false,
            'featured' => true,
            'status' => ContentStatus::PUBLISHED->value,
            'sort_order' => 4,
            'visibility' => VisibilityStatus::PUBLIC->value,
        ]);

        $expOpenSource = Experience::updateOrCreate(['slug' => 'open-source-craftops-cli'], [
            'experience_type_id' => $experienceTypes[ExperienceTypeEnum::OPEN_SOURCE->value]->id,
            'organization_id' => null,
            'title' => 'Lead Maintainer — Laravel CraftOps CLI',
            'role' => 'Open Source Creator',
            'summary' => 'Maintaining open-source developer tooling designed to automate Clean Architecture scaffolding in Laravel applications.',
            'description' => 'Authoring releases, reviewing community pull requests, maintaining test suites with 98% code coverage, and drafting documentation.',
            'contribution' => 'Wrote custom generator commands and stub templates adopted by engineering teams globally.',
            'challenge' => 'Ensuring compatibility across PHP 8.2, 8.3, 8.4, and Laravel 10 through 13 versions.',
            'solution' => 'Configured matrix automated testing workflows in GitHub Actions covering all supported language and framework matrix combinations.',
            'outcome' => 'Over 15,000+ total downloads on Packagist and 500+ GitHub stars.',
            'location' => 'Remote / Global',
            'started_at' => Carbon::parse('2024-02-01'),
            'ended_at' => null,
            'is_current' => true,
            'featured' => false,
            'status' => ContentStatus::PUBLISHED->value,
            'sort_order' => 5,
            'visibility' => VisibilityStatus::PUBLIC->value,
        ]);

        $expLeadership = Experience::updateOrCreate(['slug' => 'community-lead-laravel-indonesia'], [
            'experience_type_id' => $experienceTypes[ExperienceTypeEnum::LEADERSHIP->value]->id,
            'organization_id' => $orgOpenCollective->id,
            'title' => 'Community Organizer & Technical Advisor',
            'role' => 'Community Organizer',
            'summary' => 'Coordinating nationwide developer workshops, mentoring junior developers, and organizing technical sharing sessions.',
            'description' => 'Facilitating technical knowledge exchange, hosting monthly code labs, and curating expert guest speaker lineups.',
            'contribution' => 'Established weekly technical discussions and curated curated learning roadmaps for aspiring backend engineers.',
            'challenge' => 'Bridging the curriculum gap between theoretical university education and modern industry development expectations.',
            'solution' => 'Created hands-on open source collaborative projects where participants submit real pull requests reviewed by senior practitioners.',
            'outcome' => 'Mentored 80+ developers who successfully transitioned into professional software engineering positions.',
            'location' => 'Indonesia (National)',
            'started_at' => Carbon::parse('2023-03-01'),
            'ended_at' => null,
            'is_current' => true,
            'featured' => false,
            'status' => ContentStatus::PUBLISHED->value,
            'sort_order' => 6,
            'visibility' => VisibilityStatus::PUBLIC->value,
        ]);

        // Link Experiences to Projects, Skills, Events, Certificates, Achievements
        $expWork->projects()->sync([$projHRIS->id, $projLogistics->id]);
        $expWork->skills()->sync([$skillLaravel->id, $skillPHP->id, $skillMySQL->id, $skillDDD->id]);
        $expWork->achievements()->sync([$achBestArch->id]);
        $expWork->certificates()->sync([$certAWS->id, $certLaravel->id]);

        $expFreelance->projects()->sync([$projPayOrchestrator->id, $projAnalytics->id]);
        $expFreelance->skills()->sync([$skillLaravel->id, $skillPHP->id, $skillMySQL->id, $skillRedis->id]);

        $expHackathon->projects()->sync([$projPayOrchestrator->id]);
        $expHackathon->skills()->sync([$skillLaravel->id, $skillPHP->id, $skillDDD->id]);
        $expHackathon->achievements()->sync([$achHackathon->id]);
        $expHackathon->events()->sync([$eventHackathon->id]);

        $expSpeaking->skills()->sync([$skillLaravel->id, $skillMySQL->id]);
        $expSpeaking->events()->sync([$eventMeetup->id]);

        $expOpenSource->projects()->sync([$projCLI->id]);
        $expOpenSource->skills()->sync([$skillPHP->id, $skillLaravel->id]);

        // 14. Articles (3)
        $art1 = Article::updateOrCreate(['slug' => 'database-indexing-strategies-for-high-concurrency-laravel'], [
            'title' => 'Database Indexing Strategies for High-Concurrency Laravel Applications',
            'excerpt' => 'A practical guide to designing composite indexes, eliminating filesorts, and reading EXPLAIN query plans to drastically cut query latency.',
            'content' => "When building scalable web applications with Laravel, the database is almost always the first bottleneck to emerge under high concurrent load.\n\nWhile Eloquent makes writing complex relationships effortless, developers often overlook the actual SQL queries being generated under the hood.\n\n### 1. The Power of Left-Prefix Matching\nComposite indexes are ordered sequences. An index on `(status, published_at, category_id)` can satisfy queries filtering by `status`, or `status + published_at`, but will NOT be used if you query exclusively by `category_id`.\n\n### 2. Eliminating Using Filesort\nWhen ordering query results with `ORDER BY`, ensuring your index covers both the WHERE conditions and the ORDER BY columns avoids painful temporary table filesorts in MySQL.\n\n### 3. Real-world Benchmarks\nOn a table with 2,000,000 rows, moving from unindexed lookups to a tailored composite index reduced response time from 1,240ms to 4.2ms — an improvement exceeding 99%.",
            'thumbnail' => null,
            'category' => 'Database Performance',
            'status' => ContentStatus::PUBLISHED->value,
            'published_at' => Carbon::parse('2024-03-15 10:00:00'),
        ]);

        $art2 = Article::updateOrCreate(['slug' => 'clean-architecture-service-layers-in-laravel'], [
            'title' => 'Clean Architecture & Pragmatic Service Layers in Laravel',
            'excerpt' => 'How to separate business logic from HTTP controllers and Eloquent models without drowning in over-engineered abstractions.',
            'content' => "One of the most common pitfalls in growing Laravel applications is 'Fat Controllers' or conversely, bloated 'God Models' stuffed with business rules, notifications, and third-party API calls.\n\n### The Rule of Single Responsibility\nControllers should strictly handle HTTP concerns: validating incoming request payloads via Form Requests, invoking the appropriate domain service, and returning an HTTP response or view.\n\n### Designing Pragmatic Services\nA clean Service class shouldn't just be an empty pass-through to Eloquent. It encapsulates transactional boundaries, dispatches events, and manages domain invariants.\n\nBy following this approach, controllers stay lean, testing becomes straightforward with dedicated unit tests, and your domain logic remains completely decoupled from presentation layers.",
            'thumbnail' => null,
            'category' => 'Software Architecture',
            'status' => ContentStatus::PUBLISHED->value,
            'published_at' => Carbon::parse('2024-04-20 14:30:00'),
        ]);

        $art3 = Article::updateOrCreate(['slug' => 'resilient-asynchronous-job-queues-redis'], [
            'title' => 'Building Resilient Asynchronous Job Queues with Redis & Laravel',
            'excerpt' => 'Practical patterns for idempotency, backoff retries, atomic locks, and dead-letter queues in mission-critical background workers.',
            'content' => "Asynchronous processing is essential for maintaining snappy HTTP response times. However, background workers introduce distributed state challenges: duplicate execution, worker crashes, and network timeouts.\n\n### Enforcing Idempotency\nEvery job that touches financial ledgers or external third-party APIs must be strictly idempotent. Generating unique deterministic idempotency keys and storing processed states in Redis or MySQL prevents double-charging or duplicate payouts.\n\n### Redis Atomic Locks\nUsing `Cache::lock()` guarantees that only one worker can process a particular batch or user account concurrently, completely preventing race conditions.\n\nMastering these resilience patterns guarantees your systems remain reliable and predictable even when downstream third-party services fail.",
            'thumbnail' => null,
            'category' => 'Backend Engineering',
            'status' => ContentStatus::PUBLISHED->value,
            'published_at' => Carbon::parse('2024-06-02 09:15:00'),
        ]);

        $art1->skills()->sync([$skillMySQL->id, $skillLaravel->id]);
        $art2->skills()->sync([$skillLaravel->id, $skillDDD->id]);
        $art3->skills()->sync([$skillRedis->id, $skillLaravel->id]);

        // 15. Services (3)
        Service::updateOrCreate(['slug' => 'enterprise-backend-architecture'], [
            'title' => 'Enterprise System Architecture & Backend Engineering',
            'description' => 'Designing and implementing mission-critical backend systems, multi-tenant databases, and resilient APIs built for high throughput and long-term maintainability.',
            'icon' => 'server-stack',
            'featured' => true,
            'sort_order' => 1,
        ]);

        Service::updateOrCreate(['slug' => 'database-performance-audit'], [
            'title' => 'Database Optimization & Performance Audits',
            'description' => 'In-depth analysis of MySQL/MariaDB database schemas, slow query profiling, index optimization, and Redis caching strategies to eliminate latency bottlenecks.',
            'icon' => 'bolt',
            'featured' => true,
            'sort_order' => 2,
        ]);

        Service::updateOrCreate(['slug' => 'codebase-audit-technical-consulting'], [
            'title' => 'Codebase Modernization & Architectural Consulting',
            'description' => 'Guiding engineering teams through architectural refactoring, legacy Laravel upgrades, automated CI/CD pipeline establishment, and Clean Code standards.',
            'icon' => 'wrench-screwdriver',
            'featured' => true,
            'sort_order' => 3,
        ]);

        // 16. Social Links
        $socials = [
            ['platform' => 'github', 'username' => 'helmyyunan', 'url' => 'https://github.com/helmyyunan', 'order' => 1],
            ['platform' => 'linkedin', 'username' => 'helmy-yunan-nasution', 'url' => 'https://linkedin.com/in/helmy-yunan-nasution', 'order' => 2],
            ['platform' => 'twitter', 'username' => '@helmyyunan', 'url' => 'https://x.com/helmyyunan', 'order' => 3],
            ['platform' => 'email', 'username' => 'contact@helmyyunan.dev', 'url' => 'mailto:contact@helmyyunan.dev', 'order' => 4],
        ];

        foreach ($socials as $soc) {
            SocialLink::updateOrCreate(
                ['platform' => $soc['platform']],
                [
                    'username' => $soc['username'],
                    'url' => $soc['url'],
                    'sort_order' => $soc['order'],
                ]
            );
        }

        // 17. Settings
        $settings = [
            'site_name' => 'Helmy Yunan Nasution',
            'site_title' => 'Helmy Yunan Nasution — Personal Information & Professional Journey System',
            'site_tagline' => 'Software Engineer & System Architect',
            'contact_email' => 'contact@helmyyunan.dev',
            'enable_contact_form' => 'true',
            'enable_search' => 'true',
            'github_profile' => 'https://github.com/helmyyunan',
            'linkedin_profile' => 'https://linkedin.com/in/helmy-yunan-nasution',
        ];

        foreach ($settings as $key => $val) {
            Setting::set($key, $val, 'string');
        }

        // 18. SEO Metadata
        SeoMetadata::updateOrCreate(
            ['canonical_url' => 'https://helmyyunan.dev'],
            [
                'meta_title' => 'Helmy Yunan Nasution — Software Engineer & System Architect',
                'meta_description' => 'Personal Information & Professional Journey System of Helmy Yunan Nasution. Explore architectural case studies, empirical skill matrices, and verified career milestones.',
                'keywords' => 'Helmy Yunan Nasution, Software Engineer, System Architect, Laravel 13, MySQL, High Performance PHP, System Design',
                'og_title' => 'Helmy Yunan Nasution — Software Engineer & System Architect',
                'og_description' => 'Explore the professional journey, production projects, and verified competencies of Helmy Yunan Nasution.',
                'og_image' => 'https://helmyyunan.dev/assets/images/og-cover.png',
                'robots' => 'index, follow',
            ]
        );
    }
}

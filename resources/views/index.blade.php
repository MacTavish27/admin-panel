<?php
    $currentLocale = app()->getLocale();
    $segments = request()->segments();
    $segments[0] = 'en';
    $sectionsByType = $sectionsByType ?? collect($sections ?? [])->groupBy('type');
    $section = static fn (string $type) => $sectionsByType->get($type, collect())->first();
    $content = static fn ($section, string $key) => $section?->contentByKey($key);
    $contentsByPrefix = static fn ($section, string $prefix) => $section?->contents
        ?->filter(fn ($item) => str_starts_with($item->key ?? '', $prefix))
        ->sortBy('order')
        ->values() ?? collect();

    $headerSection = $section('header');
    $introSection = $section('intro');
    $climateSection = $section('climate');
    $programmeVisionSection = $section('programme_vision');
    $researchSection = $section('research');
    $programmeOutcomesSection = $section('programme_outcomes');
    $applySection = $section('apply');
    $teamSection = $section('team');
    $mentorsSection = $section('mentors');
    $faqSections = $sectionsByType->get('faq', collect());
    $aboutSection = $section('about');
    $footerSection = $section('footer');

    $headerBody = $headerSection?->contents->firstWhere('kind', 'rich_text')?->translated_content
        ?? $headerSection?->contents->firstWhere('kind', 'section_heading')?->translated_content
        ?? $headerSection?->contents->first()?->translated_content;
    $faqHeading = $faqSections->first()?->contents->firstWhere('kind', 'section_heading');

    $introLabel = $content($introSection, 'intro-label');
    $introBody = $content($introSection, 'intro-body');
    $introCta = $content($introSection, 'intro-cta');

    $climateBody = $content($climateSection, 'climate-body');

    $programmeVisionHeading = $content($programmeVisionSection, 'section-heading');
    $programmeVisionAbout = $content($programmeVisionSection, 'programme-vision-about');
    $programmeVisionGoals = $content($programmeVisionSection, 'programme-vision-goals');
    $programmeVisionMission = $content($programmeVisionSection, 'programme-vision-mission');
    $programmeVisionImageOne = $content($programmeVisionSection, 'programme-vision-image-one');
    $programmeVisionImageTwo = $content($programmeVisionSection, 'programme-vision-image-two');

    $researchHeading = $content($researchSection, 'section-heading');
    $researchBody = $content($researchSection, 'research-body');
    $researchThemeFood = $content($researchSection, 'research-theme-food');
    $researchThemeWater = $content($researchSection, 'research-theme-water');

    $programmeOutcomesHeading = $content($programmeOutcomesSection, 'section-heading');
    $programmeOutcomeItems = $programmeOutcomesSection?->contentsByKind('list_item') ?? collect();

    $applyHeading = $content($applySection, 'section-heading');
    $applyBody = $content($applySection, 'apply-body');
    $applyCta = $content($applySection, 'apply-cta');
    $applyBenefitsTitle = $content($applySection, 'apply-benefits-title');
    $applyBenefits = $contentsByPrefix($applySection, 'apply-benefit-item-');
    $applyRequirementsTitle = $content($applySection, 'apply-requirements-title');
    $applyRequirements = $contentsByPrefix($applySection, 'apply-requirement-item-');
    $applySelection = $content($applySection, 'apply-selection');
    $applyDocumentsTitle = $content($applySection, 'apply-documents-title');
    $applyDocumentsFormLabel = $content($applySection, 'apply-documents-form-label');
    $applyDocumentsNote = $content($applySection, 'apply-documents-note');
    $applyDocuments = $contentsByPrefix($applySection, 'apply-document-item-');
    $applyDocumentsFooterNote = $content($applySection, 'apply-documents-footer-note');

    $teamHeading = $content($teamSection, 'section-heading');
    $teamChair = $content($teamSection, 'team-chair');
    $teamChairBioLeft = $content($teamSection, 'team-chair-bio-left');
    $teamChairBioRight = $content($teamSection, 'team-chair-bio-right');
    $teamDirector = $content($teamSection, 'team-director');
    $teamProgramLead = $content($teamSection, 'team-program-lead');
    $teamProjectManager = $content($teamSection, 'team-project-manager');
    $teamLocalCoordinator = $content($teamSection, 'team-local-coordinator');
    $teamAdvisor = $content($teamSection, 'team-advisor');
    $teamResearchDevelopment = $content($teamSection, 'team-research-development');

    $mentorsHeading = $content($mentorsSection, 'section-heading');
    $mentorSagit = $content($mentorsSection, 'mentor-sagit');
    $mentorElena = $content($mentorsSection, 'mentor-elena');
    $mentorEva = $content($mentorsSection, 'mentor-eva');
    $mentorMichelle = $content($mentorsSection, 'mentor-michelle');

    $aboutHeading = $content($aboutSection, 'section-heading');
    $aboutIntro = $content($aboutSection, 'about-intro');
    $aboutBody = $content($aboutSection, 'about-body');

    $footerContactHeading = $content($footerSection, 'footer-contact-heading');
    $footerOrganisation = $content($footerSection, 'footer-organisation');
    $footerAddress = $content($footerSection, 'footer-address');
    $footerPhone = $content($footerSection, 'footer-phone');
    $footerInquiriesHeading = $content($footerSection, 'footer-inquiries-heading');
    $footerEmail = $content($footerSection, 'footer-email');
    $footerSocialHeading = $content($footerSection, 'footer-social-heading');
    $footerLinkedIn = $content($footerSection, 'footer-linkedin');
    $footerInstagram = $content($footerSection, 'footer-instagram');
    $footerNewsletterHeading = $content($footerSection, 'footer-newsletter-heading');
    $footerNewsletterPlaceholder = $content($footerSection, 'footer-newsletter-placeholder');
    $footerNewsletterButton = $content($footerSection, 'footer-newsletter-button');
    $footerOrganiserHeading = $content($footerSection, 'footer-organiser-heading');
    $footerOrganiserBody = $content($footerSection, 'footer-organiser-body');
    $footerPrivacyLink = $content($footerSection, 'footer-privacy-link');
    $footerCookieLink = $content($footerSection, 'footer-cookie-link');

    $teamPrimaryMembers = [
        ['member' => $teamDirector, 'boxClass' => 'member-box', 'bioClass' => 'team-member-bio-1'],
        ['member' => $teamProgramLead, 'boxClass' => 'member-box-2', 'bioClass' => 'team-member-bio-2'],
    ];

    $teamAdditionalMembers = [
        ['member' => $teamProjectManager, 'boxClass' => 'member-box-3', 'imageId' => 'img-big'],
        ['member' => $teamLocalCoordinator, 'boxClass' => 'member-box-4', 'imageId' => null],
        ['member' => $teamAdvisor, 'boxClass' => 'member-box-5', 'imageId' => null],
        ['member' => $teamResearchDevelopment, 'boxClass' => 'member-box-6', 'imageId' => null],
    ];

    $mentorCards = [
        ['member' => $mentorSagit, 'boxClass' => 'member-box-3 absolute', 'bioClass' => 'team-member-bio-1 absolute margin-top', 'imageId' => 'img-small'],
        ['member' => $mentorElena, 'boxClass' => 'member-box-5 absolute', 'bioClass' => 'team-member-bio-2 absolute margin-top', 'imageId' => 'img-small'],
        ['member' => $mentorEva, 'boxClass' => 'member-box-3 absolute-2', 'bioClass' => 'team-member-bio-1 absolute-2', 'imageId' => 'img-small'],
        ['member' => $mentorMichelle, 'boxClass' => 'member-box-5 absolute-2', 'bioClass' => 'team-member-bio-2 absolute-2', 'imageId' => 'img-small'],
    ];
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aral school</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
  </head>
  <body>
    <div class="grid-container">
      <div class="grid-box"></div>
      <div class="grid-box"></div>
      <div class="grid-box"></div>
      <div class="grid-box"></div>
    </div>
    <section id="navbar">
      <div id="banner">
        <div class="banner-textbox container">
          <p>Apply to the Aral School - Deadline 5th of October 2025</p>
        </div>
        <div class="lang-togglebox">
          @foreach(['en', 'uz', 'kk', 'ru'] as $lang)
            @php
                $segments[0] = $lang;
                $url = '/' . implode('/', $segments);
            @endphp

            <a href="{{ $url }}" class="{{ $currentLocale === $lang ? 'selected' : '' }}">
              {{ strtoupper($lang) }}
            </a>
          @endforeach
        </div>
      </div>
      <div id="navigation">
        <div class="aral container">
          <img src="{{ asset('logo/ARAL.svg') }}" alt="Aral" />
        </div>
        <div class="navbar-square"></div>
        <div class="menu">
          <ul>
            @foreach($menuItems as $item)
              <li>
                <a href="{{ $item->url }}">
                  {{ $item->title }}
                </a>
              </li>
            @endforeach
          </ul>
        </div>
        <div class="hamburger" id="hamburger">
          <span></span>
        </div>

        <div class="school">
          <img src="{{ asset('logo/SCHOOL.svg') }}" alt="school" />
        </div>
      </div>

      <div id="mobile-menu">
        <ul>
          @foreach($menuItems as $item)
            <li>
              <a href="{{ $item->url }}">
                {{ $item->title }}
              </a>
            </li>
          @endforeach
        </ul>

        <div class="mobile-lang-togglebox">
          @foreach(['en', 'uz', 'kk', 'ru'] as $lang)
            @php
                $segments[0] = $lang;
                $url = '/' . implode('/', $segments);
            @endphp

            <a href="{{ $url }}" class="{{ $currentLocale === $lang ? 'selected' : '' }}">
              {{ strtoupper($lang) }}
            </a>
          @endforeach
        </div>
      </div>
    </section>

    <section id="header">
      <div id="header-image">
        <img src="{{ $headerSection?->image_url }}" alt="Header Image" />
      </div>
      <div class="header-box overlay-bg-color">
        <div class="header-text">
          <p>{!! $headerBody !!}</p>
        </div>
      </div>
    </section>

    <section id="intro">
      <div class="intro-left-box">
        <svg width="100%" height="100%">
          <line x1="0" y1="100%" x2="100%" y2="2%" stroke="black" />
        </svg>
        <div class="corner-left"></div>
      </div>
      <div class="intro-info overlay-bg-color">
        <p>{!! $introLabel?->translated_title !!}</p>
        <p>{!! $introBody?->translated_content !!}</p>
      </div>
      <div class="intro-right-box">
        <svg width="100%" height="100%">
          <line x1="0" y1="0" x2="100%" y2="100%" stroke="black" />
        </svg>
        <div class="corner-right"></div>
      </div>
      <div class="apply-box">
        <div class="deadline-box">
          <p>{!! $introCta?->translated_title !!}</p>
          <p>{!! $introCta?->translated_content !!}</p>
        </div>
        <svg width="10%" height="1px">
          <line x1="0" y1="0" x2="100px" y2="0" stroke="black" />
        </svg>
        <div class="square-shape"></div>
      </div>
    </section>

    <section id="climate">
      <div class="earth-photo">
        <img src="{{ $climateSection?->image_url }}" alt="Aral Sea" />
      </div>
      <div class="climate-description">
        <p>{{ strip_tags(html_entity_decode($climateBody?->translated_content) ) }}</p> 
      </div>
    </section>

    <section id="programme-vision">
      <svg class="programme-line-right" width="50%" height="350">
        <line x1="0" y1="350" x2="50%" y2="0" stroke="black" />
      </svg>
      <svg class="programme-line-left" width="50%" height="350">
        <line x1="0" y1="0" x2="50%" y2="350" stroke="black" />
      </svg>
      <div class="vision-title overlay-bg-color">
        <p>{!! $programmeVisionHeading?->translated_title !!}</p>
      </div>
      <div class="about">
        <img src="{{ $programmeVisionAbout?->image_url }}" alt="about image" />
        <div class="modal">
          <div class="modal-text">
            <p>{!! $programmeVisionAbout?->translated_title !!}</p>
            <div class="square-shape"></div>
          </div>
          <div class="modal-description">
            <p>{!! $programmeVisionAbout?->translated_content !!}</p>
          </div>
        </div>
      </div>
      <div class="goals">
        <img src="{{ $programmeVisionGoals?->image_url }}" alt="goals image" />
        <div class="modal">
          <div class="modal-text">
            <p>{!! $programmeVisionGoals?->translated_title !!}</p>
            <div class="square-shape"></div>
          </div>
          <div class="modal-description">
            <p>{!! $programmeVisionGoals?->translated_content !!}</p>
          </div>
        </div>
      </div>
      <div class="programme-image-one">
        <img src="{{ $programmeVisionImageOne?->image_url }}" alt="programme image one" />
      </div>
      <div class="mission">
        <img src="{{ $programmeVisionMission?->image_url }}" alt="mission image" />
        <div class="modal">
          <div class="modal-text">
            <p>{!! $programmeVisionMission?->translated_title !!}</p>
            <div class="square-shape"></div>
          </div>
          <div class="modal-description">
            <p>{!! $programmeVisionMission?->translated_content !!}</p>
          </div>
        </div>
      </div>
      <div class="programme-image-two">
        <img src="{{ $programmeVisionImageTwo?->image_url }}" alt="programme image two" />
      </div>
    </section>

    <section id="research">
      <div class="research-theme">
        <div class="theme-box overlay-bg-color">
          <p>{!! $researchHeading?->translated_title !!}</p>
        </div>
      </div>
      <div class="research-description overlay-bg-color">
        <p>{!! $researchBody?->translated_content !!}</p>
      </div>
      <div class="theme-card-left">
        <div class="image-card">
          <img src="{{ $researchThemeFood?->image_url }}" alt="Food system image" />
          {!! $researchThemeFood?->translated_content !!}
          <div class="number"><p>{{ data_get($researchThemeFood?->extra, 'number') }}</p></div>
        </div>
        <div class="title-card">
          <p>{!! $researchThemeFood?->translated_title !!}</p>
        </div>
      </div>

      <div class="theme-card-right">
        <div class="image-card">
          <img src="{{ $researchThemeWater?->image_url }}" alt="Aral Water image" />
          {!! $researchThemeWater?->translated_content !!}
          <div class="number"><p>{{ data_get($researchThemeWater?->extra, 'number') }}</p></div>
        </div>
        <div class="title-card">
          <p>{!! $researchThemeWater?->translated_title !!}</p>
        </div>
      </div>
    </section>

    <section id="programme-outcomes">
      <div class="outcome-line-left-box">
        <img src="{{ asset('gallery/Graphic ornament.svg') }}" alt="Graphic ornament" />
      </div>
      <div class="outcome-title overlay-bg-color">
        <p>{!! $programmeOutcomesHeading?->translated_title !!}</p>
        <img
          class="graphic_ornament_programme_1"
          src="{{ asset('gallery/graphic_ornament_programme_1.svg') }}"
          alt="graphic ornament"
        />
        <img
          class="graphic_ornament_programme_2"
          src="{{ asset('gallery/graphic_ornament_programme_2.svg') }}"
          alt="graphic ornament"
        />
      </div>
      @foreach ($programmeOutcomeItems as $item)
        <div class="outcome-box">
          <p>{!! $item->translated_content !!}</p>
        </div>
      @endforeach
    </section>

    <section id="who-can-apply">
      <div class="apply-theme overlay-bg-color">
        <p>{!! $applyHeading?->translated_title !!}</p>
      </div>
      <div class="apply-image">
        <img src="{{ $applySection?->image_url }}" alt="Apply image" />
      </div>
      <div class="apply-image-description overlay-bg-color">
        <p>{!! $applyBody?->translated_content !!}</p>
      </div>
      <div class="apply-box">
        <div class="deadline-box">
          <p>{!! $applyCta?->translated_title !!}</p>
          <p>{!! $applyCta?->translated_content !!}</p>
        </div>
        <svg width="10%" height="1px">
          <line x1="0" y1="0" x2="100px" y2="0" stroke="black" />
        </svg>
        <div class="square-shape"></div>
        <div class="apply-square-shape-one"></div>
      </div>
      <div class="application-box-one">
        <p class="application-title">{{ strip_tags(html_entity_decode($applyBenefitsTitle?->translated_title)) }}</p>
        <div class="application-number"><p>1</p></div>
        <div class="application-content">
          <ul>
            @foreach ($applyBenefits as $item)
              <li>{{ strip_tags(html_entity_decode($item->translated_content)) }}</li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="application-box-two">
        <p class="application-title">{{ strip_tags(html_entity_decode($applyRequirementsTitle?->translated_title)) }}</p>
        <div class="application-number"><p>2</p></div>
        <div class="application-content">
          <ul>
            @foreach ($applyRequirements as $item)
              <li>{{ strip_tags(html_entity_decode($item->translated_content)) }}</li>
            @endforeach
          </ul>
        </div>
        <img src="{{ asset('svg/apply-line-two.svg') }}" alt="apply line two" />
      </div>
      <div class="application-box-three">
        <p class="application-title">{{ strip_tags(html_entity_decode($applySelection?->translated_title)) }}</p>
        <div class="application-number"><p>3</p></div>
        <div class="application-content">
          <p>{{ strip_tags(html_entity_decode($applySelection?->translated_content)) }}</p>
        </div>
        <img src="{{ asset('svg/apply-line-three.svg') }}" alt="apply line three" />
      </div>
      <div class="application-box-four">
        <p class="application-title">{{ strip_tags(html_entity_decode($applyDocumentsTitle?->translated_title)) }}</p>
        <div class="application-form">
          <p>{{ strip_tags(html_entity_decode($applyDocumentsFormLabel?->translated_content)) }}</p>
          <svg width="72px" height="1px">
            <line x1="0" y1="0" x2="72px" y2="0" stroke="black" />
          </svg>
          <div class="square-shape"></div>
        </div>
        <div class="application-number"><p>4</p></div>
        <div class="application-content-form">
          <p class="note">{{ strip_tags(html_entity_decode($applyDocumentsNote?->translated_content)) }}</p>
          <ol class="remove-margin">
            @foreach ($applyDocuments as $item)
              <li>{{ strip_tags(html_entity_decode($item->translated_content)) }}</li>
            @endforeach
          </ol>
          <p class="application-note">{{ strip_tags(html_entity_decode($applyDocumentsFooterNote?->translated_content)) }}</p>
        </div>
      </div>
    </section>

    <section id="leader-area">
      <img
        src="{{ asset('svg/team-ornament.svg') }}"
        alt="team ornament"
        class="team-ornament"
      />
      <div class="team-title overlay-bg-color">
        <p>{!! $teamHeading?->translated_title !!}</p>
      </div>
      <div class="profile-box">
        <div class="profile-box-edge">
          <img src="{{ $teamChair?->image_url }}" alt="Team lead" />
        </div>
        <img
          src="{{ asset('svg/profile-line.svg') }}"
          alt="profile line"
          class="profile-line"
        />
        <img
          src="{{ asset('svg/profile-ornament.svg') }}"
          alt="profie ornament"
          class="profile-ornament"
        />
      </div>
      <div class="profile-desc">
        <p class="leader-name">{{ strip_tags(html_entity_decode($teamChair?->translated_title)) }}</p>
        <p class="leader-title">{{ data_get($teamChair->translations->firstWhere('locale', $currentLocale)?->extra, 'role') ?? data_get($teamChair?->extra, 'role') }}</p>
      </div>
      <div class="team-lead-bio">
        <p>{!! $teamChairBioLeft?->translated_content !!}</p>
      </div>
      <div class="team-lead-bio-right">
        <p>{!! $teamChairBioRight?->translated_content !!}</p>
      </div>
    </section>

    <section id="team">
      @foreach ($teamPrimaryMembers as $teamMember)
        <div class="{{ $teamMember['boxClass'] }}">
          <div class="profile-box">
            <div class="profile-box-edge">
              <img src="{{ $teamMember['member']?->image_url }}" alt="Team member" />
            </div>
            <img
              src="{{ asset('svg/profile-line.svg') }}"
              alt="profile line"
              class="profile-line"
            />
          </div>
          <div class="profile-desc">
            <p class="leader-name">{{ strip_tags(html_entity_decode($teamMember['member']?->translated_title)) }}</p>
            <p class="leader-title">{{ data_get($teamMember['member']?->translations->firstWhere('locale', $currentLocale)?->extra, 'role') ?? data_get($teamMember['member']?->extra, 'role') }}</p>
          </div>
        </div>
        <div class="{{ $teamMember['bioClass'] }}">
          <p>{!! $teamMember['member']?->translated_content !!}</p>
        </div>
      @endforeach
    </section>

    <section id="rest-members">
      @foreach ($teamAdditionalMembers as $teamMember)
        <div class="{{ $teamMember['boxClass'] }}">
          <div class="profile-box">
            <div class="profile-box-edge">
              <img
                src="{{ $teamMember['member']?->image_url }}"
                alt="Team member"
                @if ($teamMember['imageId']) id="{{ $teamMember['imageId'] }}" @endif
              />
            </div>
            <img
              src="{{ asset('svg/profile-line.svg') }}"
              alt="profile line"
              class="profile-line"
            />
          </div>
          <div class="profile-desc">
            <p class="leader-name">{{ strip_tags(html_entity_decode($teamMember['member']?->translated_title)) }}</p>
            <p class="leader-title">{{ data_get($teamMember['member']?->translations->firstWhere('locale', $currentLocale)?->extra, 'role') ?? data_get($teamMember['member']?->extra, 'role') }}</p>
            <p>{!! $teamMember['member']?->translated_content !!}</p>
          </div>
        </div>
      @endforeach
    </section>

    <section id="mentors">
      <div class="mentor-header overlay-bg-color">
        <div class="mentor-header-box"><p>{!! $mentorsHeading?->translated_title !!}</p></div>
      </div>
      <img src="{{ asset('svg/mentor-line.svg') }}" alt="mentor line" class="mentor-line" />

      @foreach ($mentorCards as $mentorCard)
        <div class="{{ $mentorCard['boxClass'] }}">
          <p class="field">{{ data_get($mentorCard['member']?->translations->firstWhere('locale', $currentLocale)?->extra, 'field') ?? data_get($mentorCard['member']?->extra, 'field') }}</p>
          <div class="profile-box">
            <div class="profile-box-edge">
              <img
                src="{{ $mentorCard['member']?->image_url }}"
                alt="Team member"
                id="{{ $mentorCard['imageId'] }}"
              />
            </div>
            <img
              src="{{ asset('svg/profile-line.svg') }}"
              alt="profile line"
              class="profile-line"
            />
          </div>
          <div class="profile-desc">
            <p class="leader-name">{{ strip_tags(html_entity_decode($mentorCard['member']?->translated_title)) }}</p>
          </div>
        </div>
        <div class="{{ $mentorCard['bioClass'] }}">
          <p>{!! $mentorCard['member']?->translated_content !!}</p>
        </div>
      @endforeach
    </section>

    <section id="FAQ">
      <div class="faq-box">
        <p class="faq-title">{{ $faqHeading?->translated_title ?? 'FAQ' }}</p>

        @foreach ($faqSections as $section)
          @php
              $faqItems = $section->contents->where('kind', 'faq_item')->values();
          @endphp

          @if ($faqItems->isNotEmpty())
            <div class="faq-listbox">
              @foreach ($faqItems as $item)
                <div class="faq-item">
                  <div class="faq-question">
                    <p>{{ strip_tags(html_entity_decode($item->translated_title)) }}</p>
                    <img src="{{ asset('svg/Arrow.svg') }}" alt="Arrow" />
                  </div>

                  <div class="faq-answer">
                    <p>{!! $item->translated_content !!}</p>
                  </div>
                </div>
              @endforeach
            </div>
          @endif
        @endforeach
      </div>
      <img src="{{ asset('gallery/FAQ-1.jpg') }}" alt="faq-1" class="faq-img-1" />
      <img src="{{ asset('gallery/FAQ-2.jpg') }}" alt="faq-2" class="faq-img-2" />
      <img src="{{ asset('gallery/FAQ-3.jpg') }}" alt="faq-3" class="faq-img-3" />
      <img
        src="{{ asset('svg/faq-ornament.svg') }}"
        alt="faq ornament"
        class="faq-ornament"
      />
    </section>

    <section id="about">
      <img src="{{ asset('svg/about-line.svg') }}" alt="about-line" />
      <div class="about-title overlay-bg-color"><p>{!! $aboutHeading?->translated_title !!}</p></div>
      <div class="about-box">
        <div class="about-left">
          <p>{!! $aboutIntro?->translated_content !!}</p>
        </div>
        <div class="about-right">
          <p>{!! $aboutBody?->translated_content !!}</p>
        </div>
      </div>
    </section>

    <section id="footer">
      <div class="top-layer overlay-bg-color"></div>
      <div class="contact">
        <p class="footer-title">{{ strip_tags($footerContactHeading?->translated_title) }}</p>
        <p class="org-name">{!! $footerOrganisation?->translated_content !!}</p>
        <p class="address">{!! $footerAddress?->translated_content !!}</p>
        <p class="phone">
          {{ strip_tags($footerPhone?->translated_title) }} <span>{{ strip_tags($footerPhone?->translated_content) }}</span>
        </p>
        <br />
        <p class="footer-title">{{ strip_tags(html_entity_decode($footerInquiriesHeading?->translated_title)) }}</p>
        <p class="email">{!! $footerEmail?->translated_content !!}</p>
      </div>

      <div class="social-media">
        <p class="footer-title">{{ strip_tags(html_entity_decode($footerSocialHeading?->translated_title)) }}</p>
        <a href="{{ $footerLinkedIn?->translated_content ?? '#' }}"> {{ $footerLinkedIn?->translated_title }} ↗ </a> <br />
        <a href="{{ $footerInstagram?->translated_content ?? '#' }}"> {{ $footerInstagram?->translated_title }} ↗ </a>
      </div>
      <div class="logo-footer">
        <img src="{{ asset('logo/ARAL.svg') }}" alt="Aral" id="footer-aral" />
        <img src="{{ asset('logo/SCHOOL.svg') }}" alt="School" id="footer-school" />
        <div class="footer-square"></div>
      </div>  
      <div class="email-form overlay-bg-color">
        <p class="footer-title">{{ strip_tags(html_entity_decode($footerNewsletterHeading?->translated_title)) }}</p>
        <form action="" class="form">
          <input type="email" placeholder="{{ strip_tags(html_entity_decode($footerNewsletterPlaceholder?->translated_content)) }}" />
          <button type="submit">{{ strip_tags($footerNewsletterButton?->translated_content) }}</button>
        </form>
      </div>

      <div class="footer-overlay">
        <div class="footer-banner">
          <img src="{{ asset('svg/ACDF_logo-en 1.svg') }}" alt="ACDF logo" />
        </div>
        <div class="organiser">
          <p>{{ strip_tags(html_entity_decode($footerOrganiserHeading?->translated_title)) }}</p>
          <p>{!! $footerOrganiserBody?->translated_content !!}</p>
        </div>
        <div class="privacy">
          <ul>
            <li><a href="{{ $footerPrivacyLink?->translated_content ?? '#' }}">{{ strip_tags($footerPrivacyLink?->translated_title) }}</a></li>
            <li><a href="{{ $footerCookieLink?->translated_content ?? '#' }}">{{ strip_tags($footerCookieLink?->translated_title) }}</a></li>
          </ul>
        </div>
      </div>
      <div class="bottom-layer overlay-bg-color"></div>
    </section>
  </body>
  <script>
    window.addEventListener("scroll", function () {
      const navbar = document.getElementById("navbar");

      if (window.scrollY > 50) {
        navbar.classList.add("scrolled");
      } else {
        navbar.classList.remove("scrolled");
      }
    });

    const hamburger = document.getElementById("hamburger");
    const menu = document.getElementById("mobile-menu");
    const faqItems = document.querySelectorAll(".faq-item");
    const modals = document.querySelectorAll(".modal");

    hamburger.addEventListener("click", () => {
      hamburger.classList.toggle("active");
      menu.classList.toggle("active");
    });

    modals.forEach((modal) => {
      const trigger = modal.querySelector(".modal-text");

      trigger.addEventListener("click", () => {
        modal.classList.toggle("active");
      });
    });

    faqItems.forEach((item) => {
      const question = item.querySelector(".faq-question");
      question.addEventListener("click", () => {
        faqItems.forEach((i) => {
          if (i !== item) i.classList.remove("active");
        });

        item.classList.toggle("active");
      });
    });
  </script>
</html>

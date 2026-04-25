<?php
    $currentLocale = app()->getLocale();
    $segments = request()->segments();
    $segments[0] = 'en';
    $sectionsByType = $sectionsByType ?? collect($sections ?? [])->groupBy('type');
    $headerSections = $sectionsByType->get('header', collect());
    $faqSections = $sectionsByType->get('faq', collect());
    $headerSection = $headerSections->first();
    $headerBody = $headerSection?->contents->firstWhere('kind', 'rich_text')?->translated_content
        ?? $headerSection?->contents->firstWhere('kind', 'section_heading')?->translated_content
        ?? $headerSection?->contents->first()?->translated_content;
    $faqHeading = $faqSections->first()?->contents->firstWhere('kind', 'section_heading');

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
        @foreach(['en','uz','kk','ru'] as $lang)
          @php
        $segments[0] = $lang;
        $url = '/' . implode('/', $segments);
          @endphp

          <a href="{{ $url }}"
          class="{{ $currentLocale == $lang ? 'selected' : '' }}">
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
        <!-- Hamburger -->
        <div class="hamburger" id="hamburger">
          <span></span>
        </div>

        <div class="school">
          <img src="{{ asset('logo/SCHOOL.svg') }}" alt="school" />
        </div>
      </div>

      <!-- Mobile Menu -->
      <div id="mobile-menu">
        <ul>
          <li><a href="#">Aral School</a></li>
          <li><a href="#programme-vision">Programme</a></li>
          <li><a href="#">Apply</a></li>
          <li><a href="#">Team</a></li>
          <li><a href="#">FAQ</a></li>
          <li><a href="#">About ACDF</a></li>
          <li><a href="#">Aral Culture Summit</a></li>
        </ul>

        <div class="mobile-lang-togglebox">
          <a href="#" type="button" id="en" class="selected">EN</a>
          <a href="#" type="button" id="uz">UZ</a>
          <a href="#" type="button" id="kk">KK</a>
          <a href="#" type="button" id="ru">RU</a>
        </div>
      </div>
    </section>
    <section id="header">
      <div id="header-image">
        <img src="{{ asset('storage/' . $headerSection?->image) }}" alt="Header Image">
      </div>
      <div class="header-box overlay-bg-color">
        <div class="header-text">
          <p>
            {!! $headerBody !!}
          </p>
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
        <p>Aral School</p>
        <p>
          We are pleased to announce the Aral School, the new education
          programme beginning in 2026,  led by Jan Boelen and commissioned by
          the Uzbekistan Art and Culture Development Foundation.
        </p>
      </div>
      <div class="intro-right-box">
        <svg width="100%" height="100%">
          <line x1="0" y1="0" x2="100%" y2="100%" stroke="black" />
        </svg>
        <div class="corner-right"></div>
      </div>
      <div class="apply-box">
        <div class="deadline-box">
          <p>Apply now</p>
          <p>Deadline 5th of October 2025</p>
        </div>
        <svg width="10%" height="1px">
          <line x1="0" y1="0" x2="100px" y2="0" stroke="black" />
        </svg>
        <div class="square-shape"></div>
      </div>
    </section>
    <section id="climate">
      <div class="earth-photo">
        <img src="{{ asset('gallery/aral_photo.jpg') }}" alt="Aral Sea" />
      </div>
      <div class="climate-description">
        <p>
          The climate crisis is leaving an indelible mark on our ecosystems and
          bioregions, forcing us to rethink our interdependencies and alliances.
          North Uzbekistan and the Karakalpakstan area were once home to the
          vast Aral Sea, a lake in Central Asia that was for most of the 20th
          century the world’s fourth largest saline lake. In the last fifty
          years, the lake has dramatically dried up, with a radical increase in
          salinisation, primarily due to unsustainable irrigation practices
          linked to intensive, large-scale cotton cultivation. The consequences
          have irreversibly altered a bioregion and caused the collapse of an
          ecosystem, with serious impact on local communities and the region’s
          ecology, economy, culture, and public health. <br /><br />

          The Aral School is an interdisciplinary postgraduate programme that
          recognises the unique characteristics of this context, as well as the
          dramatic consequences of this ecosystem’s collapse. In a lucid
          approach, the school takes these as the starting point to create new
          and sustainable visions and prototypes for a shared future. The
          programme brings together international and local participants from
          Uzbekistan and Karakalpakstan to explore innovative solutions for
          cultural and ecological regeneration. Learning from the traditions,
          biocultural context, and environmental pressure of the Karakalpakstan
          region, the programme fosters new ways of learning and collaborating
          across disciplines.
        </p>
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
        <p>
          Programme <br />
          vision
        </p>
      </div>
      <div class="about">
        <img src="{{ asset('gallery/about_photo.jpg') }}" alt="about image" />
        <div class="modal">
          <div class="modal-text">
            <p>About</p>
            <div class="square-shape"></div>
          </div>
          <div class="modal-description">
            <p>
              The Aral school wants to connect a new generation of design
              practitioners, and position Uzbekistan as a global laboratory of
              the future. Working from the Aral Sea region context, the
              initiative promotes regenerative practices, stimulates new ways of
              learning and collaborating, and learns from local know-how,
              communities and stakeholders.  The postgraduate programme brings
              together twenty participants per year, each cohort contributing to
              create a growing global community around themes of sustainability
              and regeneration. With a yearly programme of events around the
              globe, including a presentation at the Milan Design Week 2026 and
              the Aral Culture Summit later on in October 2026, the Aral School
              becomes a global platform for knowledge exchange on ecological
              restoration and sustainability.
            </p>
          </div>
        </div>
      </div>
      <div class="goals">
        <img src="{{ asset('gallery/goals.jpg') }}" alt="goals image" />
        <div class="modal">
          <div class="modal-text">
            <p>Goals</p>
            <div class="square-shape"></div>
          </div>
          <div class="modal-description">
            <p>
              The Aral school wants to connect a new generation of design
              practitioners, and position Uzbekistan as a global laboratory of
              the future. Working from the Aral Sea region context, the
              initiative promotes regenerative practices, stimulates new ways of
              learning and collaborating, and learns from local know-how,
              communities and stakeholders.  The postgraduate programme brings
              together twenty participants per year, each cohort contributing to
              create a growing global community around themes of sustainability
              and regeneration. With a yearly programme of events around the
              globe, including a presentation at the Milan Design Week 2026 and
              the Aral Culture Summit later on in October 2026, the Aral School
              becomes a global platform for knowledge exchange on ecological
              restoration and sustainability.
            </p>
          </div>
        </div>
      </div>
      <div class="programme-image-one">
        <img
          src="{{ asset('gallery/programme-image-one.png') }}"
          alt="programme image one"
        />
      </div>
      <div class="mission">
        <img src="{{ asset('gallery/mission.jpg') }}" alt="mission image" />
        <div class="modal">
          <div class="modal-text">
            <p>Mission</p>
            <div class="square-shape"></div>
          </div>
          <div class="modal-description">
            <p>
              The Aral school wants to connect a new generation of design
              practitioners, and position Uzbekistan as a global laboratory of
              the future. Working from the Aral Sea region context, the
              initiative promotes regenerative practices, stimulates new ways of
              learning and collaborating, and learns from local know-how,
              communities and stakeholders.  The postgraduate programme brings
              together twenty participants per year, each cohort contributing to
              create a growing global community around themes of sustainability
              and regeneration. With a yearly programme of events around the
              globe, including a presentation at the Milan Design Week 2026 and
              the Aral Culture Summit later on in October 2026, the Aral School
              becomes a global platform for knowledge exchange on ecological
              restoration and sustainability. The Aral school wants to connect a
              new generation of design practitioners, and position Uzbekistan as
              a global laboratory of the future. Working from the Aral Sea
              region context, the initiative promotes regenerative practices,
              stimulates new ways of learning and collaborating, and learns from
              local know-how, communities and stakeholders.  The postgraduate
              programme brings together twenty participants per year, each
              cohort contributing to create a growing global community around
              themes of sustainability and regeneration. With a yearly programme
              of events around the globe, including a presentation at the Milan
              Design Week 2026 and the Aral Culture Summit later on in October
              2026, the Aral School becomes a global platform for knowledge
              exchange on ecological restoration and sustainability.
            </p>
          </div>
        </div>
      </div>
      <div class="programme-image-two">
        <img
          src="{{ asset('gallery/programme-image-two.jpg') }}"
          alt="programme image two"
        />
      </div>
    </section>
    <section id="research">
      <div class="research-theme">
        <div class="theme-box overlay-bg-color">
          <p>Core research themes</p>
        </div>
      </div>
      <div class="research-description overlay-bg-color">
        <p>
          The two first themes of the Aral School Pilot examine food and water.
          Two interconnected research topics that are influencing the way we
          produce and consume food, our livelihood and global biodiversity. We
          need to develop and speculate new strategies and design new systems to
          prototype possible futures in order to inspire, building hope. The
          topics are at the same time our alibi and point of departure to
          introduce holistic eco-systemic projects that would build a new
          bioregion from molecular to bioregional scale. 
        </p>
      </div>
      <div class="theme-card-left">
        <div class="image-card">
          <img src="{{ asset('gallery/food.jpg') }}" alt="Food system image" />
          <p>
            When ecological systems are changing or collapsing, agriculture
            needs to adapt. What kind of sustainable food systems in
            Karalpakstan and the Aral Sea region at a larger scale can we
            develop? New agroecological approach in the city of Nukus and beyond
            will be explored and developed, creating a sustainable framework for
            a resilient and equitable future.
          </p>
          <div class="number"><p>1</p></div>
        </div>
        <div class="title-card">
          <p>The Food System <br />of the Aral region</p>
        </div>
      </div>

      <div class="theme-card-right">
        <div class="image-card">
          <img src="{{ asset('gallery/aral_water.jpg') }}" alt="Aral Water image" />
          <p>
            In the region where water evaporated by human activities we want to
            bring back water in everyday life to increase the quality of life.
            As a new benchmark for the water ecosystem, this theme explores new
            opportunities, partnerships, tools and collaborations that will
            elevate the most precious source of. Reshaping the future of the
            region through new water ethics, and principles of the bioregional
            design.
          </p>
          <div class="number"><p>2</p></div>
        </div>
        <div class="title-card">
          <p>Water of the Aral <br />region</p>
        </div>
      </div>
    </section>
    <section id="programme-outcomes">
      <div class="outcome-line-left-box">
        <img src="{{ asset('gallery/Graphic ornament.svg') }}" alt="Graphic ornament" />
      </div>
      <div class="outcome-title overlay-bg-color">
        <p>
          Programme <br />
          outcomes
        </p>
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
      <div class="outcome-box">
        <p>
          Design prototypes connected to the core themes developed within the
          research groups.
        </p>
      </div>
      <div class="outcome-box">
        <p>
          Media publication capturing the process, key research questions and
          prototype solutions will be published within 2026.
        </p>
      </div>
      <div class="outcome-box">
        <p>
          First ideas  will be shared with the global creative public during
          Milan Design Week 2026 and Aral Culture Summit 2026, additional
          cultural outposts for the prototypes exhibition might also take place.
        </p>
      </div>
      <div class="outcome-box">
        <p>
          Key research outcomes and ideas will be shared in an exhibition and
          publication during the second Aral Culture Summit in October 2026 as
          part of the programme. 
        </p>
      </div>
    </section>
    <section id="who-can-apply">
      <div class="apply-theme overlay-bg-color">
        <p>Who can apply</p>
      </div>
      <div class="apply-image">
        <img src="{{ asset('gallery/apply-image.jpg') }}" alt="Apply image" />
      </div>
      <div class="apply-image-description overlay-bg-color">
        <p>
          The multidisciplinary programme is aimed at young professionals from
          Uzbekistan and abroad with varied backgrounds and work experience in
          the fields of architecture, urbanism, environmental science, biotech,
          climate studies, filmmaking, media, crafts, design, computer
          technologies, social studies, physical sciences and other fields.
          <br /><br />
          It is recommended that applicants to the programme have a higher
          education diploma (in any specialisation) and no less than 2–3 years
          of work experience. <br /><br />
          When reviewing applications, we focus on how potential researchers
          could apply their expertise to the research agenda of the programme
          and current theme.
        </p>
      </div>
      <div class="apply-box">
        <div class="deadline-box">
          <p>Apply now</p>
          <p>Deadline 5th of October 2025</p>
        </div>
        <svg width="10%" height="1px">
          <line x1="0" y1="0" x2="100px" y2="0" stroke="black" />
        </svg>
        <div class="square-shape"></div>
        <div class="apply-square-shape-one"></div>
      </div>
      <div class="application-box-one">
        <p class="application-title">What is in it for applicants?</p>
        <div class="application-number"><p>1</p></div>
        <div class="application-content">
          <ul>
            <li>No tuition fee</li>
            <li>
              Prototyping, material costs, research trips and accommodation are
              included
            </li>
            <li>Monthly participation stipend</li>
            <li>
              Visibility and exposure to global and local creative network
            </li>
            <li>Contact with international experts on a 1-1 basis</li>
            <li>
              Publication of the cohort developments and outcome in a respective
              print format
            </li>
            <li>
              A growing cohort of Aral School alumni, who remain connected in
              the future
            </li>
          </ul>
        </div>
      </div>
      <div class="application-box-two">
        <p class="application-title">Application Requirements</p>
        <div class="application-number"><p>2</p></div>
        <div class="application-content">
          <ul>
            <li>Completed higher education</li>
            <li>2–3 years of work experience</li>
            <li>Fluency in English</li>
            <li>High level of motivation and self-organisation</li>
          </ul>
        </div>
        <img src="{{ asset('svg/apply-line-two.svg') }}" alt="apply line two" />
      </div>
      <div class="application-box-three">
        <p class="application-title">Selection Process</p>
        <div class="application-number"><p>3</p></div>
        <div class="application-content">
          <p>
            Upon applications and portfolio review, selected candidates will be
            invited for a creative interview session to share their areas of
            interests and motivations.
          </p>
        </div>
        <img src="{{ asset('svg/apply-line-three.svg') }}" alt="apply line three" />
      </div>
      <div class="application-box-four">
        <p class="application-title">Required documents</p>
        <div class="application-form">
          <p>Completed online application form</p>
          <svg width="72px" height="1px">
            <line x1="0" y1="0" x2="72px" y2="0" stroke="black" />
          </svg>
          <div class="square-shape"></div>
        </div>
        <div class="application-number"><p>4</p></div>
        <div class="application-content-form">
          <p class="note">
            Please submit the following documents together with your
            application: 
          </p>
          <ol class="remove-margin">
            <li>
              CV + Creative Portfolio (PDF, not exceeding a total of 10 pages
              and 5 projects) - your portfolio should contain examples of
              projects and/or research work completed in the last few years and
              demonstrate your skills and expertise as well as interest in the
              themes of focus of the Aral School. Please embed any video
              material within the Portfolio PDF 
            </li>
            <li>Copy of a university diploma </li>
            <li>
              Motivation letter – please explain in no more than 600 words why
              you are interested in the program and how it connects to your area
              of research or practice
            </li>
            <li>Passport photo page scan.  </li>
          </ol>
          <p class="application-note">
            Please note, only fully completed applications as per the list above
            will be considered. 
          </p>
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
        <p>The team</p>
      </div>
      <div class="profile-box">
        <div class="profile-box-edge">
          <img src="{{ asset('team/team_lead.jpg') }}" alt="Team lead" />
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
        <p class="leader-name">Gayane Umerova</p>
        <p class="leader-title">Project Chair</p>
      </div>
      <div class="team-lead-bio">
        <p>
          Gayane Umerova is dedicated to developing the culture sector in
          Uzbekistan. <br />
          <br />Head of the Department of Creative Economy and Tourism of the
          Administration of the President of the Republic of Uzbekistan and
          Chairperson of the Uzbekistan Art and Culture Development Foundation
          (ACDF), Gayane Umerova is at the helm of building Uzbekistan’s
          cultural infrastructure. Her efforts are bringing the nation’s art,
          artists, and cultural heritage into the global spotlight. Currently,
          she is overseeing the restoration and development of the Centre for
          Contemporary Arts in Tashkent, poised to become a new cultural hub for
          the region, and is the commissioner of the Bukhara Biennial (5
          September - 20 November 2025). She has spearheaded the inaugural Aral
          Culture Summit (April 4-6, 2025); is driving the construction of the
          new Uzbekistan National Museum designed by Tadao Ando and is leading
          the forthcoming 43rd session of the UNESCO General Conference that
          will take place in Samarkand on 30 October - 13 November 2025. She is
          the commissioner for the Uzbekistan Pavilion at the Venice Biennale
          Arte and Architettura since 2021 as well as for Uzbekistan’s
          participation in Expo 2025 Osaka, among other significant projects.
        </p>
      </div>
      <div class="team-lead-bio-right">
        <p>
          Committed to boosting Uzbekistan’s prominence on the international
          culture scene, Umerova serves as the Chairperson of the National
          Commission of Uzbekistan on UNESCO Affairs under the Cabinet of
          Ministers and in April 2025 has been awarded France’s Order of Arts
          and Literature. Her public service commitment is evident in her
          dedication to creating opportunities for young people in Uzbekistan’s
          cultural sector and fostering a cultural economy that unites
          communities and generations.
        </p>
      </div>
    </section>
    <section id="team">
      <div class="member-box">
        <div class="profile-box">
          <div class="profile-box-edge">
            <img src="{{ asset('team/Jan.jpg') }}" alt="Team member" />
          </div>
          <img
            src="{{ asset('svg/profile-line.svg') }}"
            alt="profile line"
            class="profile-line"
          />
        </div>
        <div class="profile-desc">
          <p class="leader-name">Jan Boelen</p>
          <p class="leader-title">Project Director</p>
        </div>
      </div>
      <div class="team-member-bio-1">
        <p>
          Jan Boelen is a curator of design, architecture, and contemporary art.
          He is the artistic director of Atelier LUMA, an experimental
          laboratory for design in Arles, France. Boelen studied Product Design
          at Genk and is the founder and former artistic director of Z33 – House
          for contemporary art in Hasselt, Belgium. He was founder of the Master
          Social design at the Design Academy of Eindhoven till 2020 and Rektor
          of the Karlsruhe University of Arts and Design from 2019 till 2023. In
          2014 he curated BIO50, the design biennial of Ljubljana in Slovenia.
          He was curator of the 4th Istanbul Design Biennial in Istanbul (2018)
          and initiated Manifesta 9 in Belgium (2012). Lastly, Boelen curated
          the Lithuanian Pavilion Planet of People in the Venice Architecture
          Biennial (2021). <br />
          <br />
          Over the years he has been fashioning projects and exhibitions that
          encourage the visitor to look at everyday objects in a novel manner.
          <br />
          <br />Boelen recently edited Social Matter, Social Design: For Good or
          Bad, all Design is Social (Valiz, 2020), and Muller Van Severen:
          Dialogue (Walther Koenig, 2021) and Atelier Luma, Bioregional design
          practices (Luma, 2023) His writing addresses the implications of
          design in everyday life and how artistic practices can shape the
          discipline.
        </p>
      </div>
      <div class="member-box-2">
        <div class="profile-box">
          <div class="profile-box-edge">
            <img src="{{ asset('team/Ksenia.png') }}" alt="Team member" />
          </div>
          <img
            src="{{ asset('svg/profile-line.svg') }}"
            alt="profile line"
            class="profile-line"
          />
        </div>
        <div class="profile-desc">
          <p class="leader-name">Ksenia Starikova-Pozzoli</p>
          <p class="leader-title">Program Lead</p>
        </div>
      </div>
      <div class="team-member-bio-2">
        <p>
          Ksenia is a design curator and creative strategist with a focus on
          circular innovations and regenerative place making. London School of
          Economics and Stanford graduate, she brings over 15 years of creative
          leadership and programme management across a variety of impact-driven
          brands, sectors and organisations. A journalist by background, she
          gradually centered her thinking at the intersection of science, design
          & new technologies, leading one of WPP design & innovation practices
          in London and NYC. <br /><br />
          Her subsequent brand leadership of the iconic Design Hotels platform
          allowed for a greater focus on the topics of Community, Impact &
          Sustainability and led to her authorship of the first Regenerative
          Placemaking framework in Travel, widely adopted by the industry since
          then across the globe. <br /><br />
          Driven by her interests in sustainable design practices, Ksenia now
          runs her own design studio, working with impact and climate-driven
          ventures and organisations on their content, programming and community
          initiatives. <br /><br />  She is also a curator of the largest
          climate tech festival in the UK, The Heat, and is focused on
          supporting a diverse range of pioneering bio design innovations in
          Fashion, Design and Architecture as part of it.
        </p>
      </div>
    </section>
    <section id="rest-members">
      <div class="member-box-3">
        <div class="profile-box">
          <div class="profile-box-edge">
            <img src="{{ asset('team/Khan.png') }}" alt="Team member" id="img-big" />
          </div>
          <img
            src="{{ asset('svg/profile-line.svg') }}"
            alt="profile line"
            class="profile-line"
          />
        </div>
        <div class="profile-desc">
          <p class="leader-name">Khudoyorkhon Abdujabborov </p>
          <p class="leader-title">Project Manager</p>
          <p>
            Khudoyorkhon Abdujabborov is a project manager at the Aral School,
            responsible for coordinating partnerships, exhibitions, and local
            implementation across Karakalpakstan. He brings extensive experience
            in international cultural collaboration, having managed key
            initiatives for the Uzbekistan Art and Culture Development
            Foundation, including the exhibition “A Glimpse Through Time: The
            Legacy of Khudaybergen Devanov” at UNESCO in Paris and the
            redevelopment of the permanent collection at the State Museum of
            Arts named after I.V. Savitsky in Nukus. Prior to this, he worked in
            diplomatic and cultural roles at the Embassy of Poland in Uzbekistan
            and the El-Yurt Umidi Foundation. He holds a degree in International
            Relations from Kazan Federal University and is also a laureate of an
            international circus arts festival, with performance experience in
            Uzbekistan, Mexico, and the USA.
          </p>
        </div>
      </div>
      <div class="member-box-4">
        <div class="profile-box">
          <div class="profile-box-edge">
            <img src="{{ asset('team/Gulnara.jpg') }}" alt="Team member" />
          </div>
          <img
            src="{{ asset('svg/profile-line.svg') }}"
            alt="profile line"
            class="profile-line"
          />
        </div>
        <div class="profile-desc">
          <p class="leader-name">Gulnara Joldasbaeva   </p>
          <p class="leader-title">Local Coordinator</p>
          <p>
            Gulnara Joldasbaeva is a cultural producer, educator, and local
            coordinator of the Aral Culture Summit in Karakalpakstan. She
            curates interdisciplinary events connecting ecology, heritage, and
            contemporary art. As part of the School, she brings together
            artists, scientists, and community members to reflect on the Aral
            Sea crisis through creative formats. In partnership with UNDP, she
            also launched Bilim, a platform offering programming and language
            education to young women in underrepresented communities. Her
            experience in ecological education and local cultural engagement
            makes her an essential link between artistic content and regional
            relevance.
          </p>
        </div>
      </div>
      <div class="member-box-5">
        <div class="profile-box">
          <div class="profile-box-edge">
            <img src="{{ asset('team/Cyril.jpg') }}" alt="Team member" />
          </div>
          <img
            src="{{ asset('svg/profile-line.svg') }}"
            alt="profile line"
            class="profile-line"
          />
        </div>
        <div class="profile-desc">
          <p class="leader-name">Cyril <br />Zammit</p>
          <p class="leader-title">Advisor</p>
          <p>
            Cyril Zammit is an independent advisor and design consultant, with a
            career devoted to supporting cultural and creative initiatives
            across the Middle East and Central Asia. <br /><br />
            He began his professional journey at the Institut Français in
            Prague, followed by a role at the Cultural Department of the French
            Embassy in London. He later moved to Switzerland, where he oversaw
            international sponsorship for the Montreux Jazz Festival, before
            taking on cultural sponsorship roles at UBS and HSBC Private Bank.
            <br /><br />
            In 2009, Cyril relocated to the UAE, where he played a key role in
            launching Abu Dhabi Art, and went on to establish Design Days Dubai
            and Dubai Design Week. He later served as an advisor to Dubai
            Culture & Arts Authority, and subsequently joined the UAE Ministry
            of Foreign Affairs & International Cooperation as a Cultural Affairs
            Expert in the Office of Public and Cultural Diplomacy. <br /><br />
            Since March 2022, he has been advising the Uzbekistan Art and
            Culture Development Foundation. In 2023, he also became an advisor
            to L’ÉCOLE Middle East in Dubai and was appointed Design Consultant
            to the Royal Commission for AlUla. Cyril is also a regular design
            columnist for Esquire Middle East.
          </p>
        </div>
      </div>
      <div class="member-box-6">
        <div class="profile-box">
          <div class="profile-box-edge">
            <img src="{{ asset('team/Anastasia.jpg') }}" alt="Team member" />
          </div>
          <img
            src="{{ asset('svg/profile-line.svg') }}"
            alt="profile line"
            class="profile-line"
          />
        </div>
        <div class="profile-desc">
          <p class="leader-name">Anastasia <br />Sinitsyna</p>
          <p class="leader-title">Research & Development</p>
          <p>
            Anastasia Sinitsyna is a researcher and cultural consultant working
            at the intersection of environmental humanities, design, and
            education. She is currently based in Venice, Italy, where she
            coordinates international exhibitions and cultural initiatives,
            including the Spanish (2023) and Uzbekistan (2022-2025) National
            Pavilions at the Venice Biennale. Her work focuses on ecological
            transformation, sustainable futures, and the role of art and
            education in reimagining cultural and physical landscapes. 
            <br /><br />
            Anastasia also leads research and programming for the Aral Culture
            Summit, a long-term initiative of ACDF aimed at supporting
            biocultural diversity and ecological regeneration in Karakalpakstan
            and the broader Aral Sea region
          </p>
        </div>
      </div>
    </section>
    <section id="mentors">
      <div class="mentor-header overlay-bg-color">
        <div class="mentor-header-box"><p>Mentors & Experts</p></div>
      </div>
      <img src="{{ asset('svg/mentor-line.svg') }}" alt="mentor line" class="mentor-line" />
      <div class="member-box-3 absolute">
        <p class="field">Water</p>
        <div class="profile-box">
          <div class="profile-box-edge">
            <img src="{{ asset('team/Sagit.png') }}" alt="Team member" id="img-small" />
          </div>
          <img
            src="{{ asset('svg/profile-line.svg') }}"
            alt="profile line"
            class="profile-line"
          />
        </div>
        <div class="profile-desc">
          <p class="leader-name">Sagitjan Aytjanov   </p>
        </div>
      </div>
      <div class="team-member-bio-1 absolute margin-top">
        <p>
          Sagitjan has a profound experience in the field of complex projects
          management with technical expertise in programs planning, management,
          monitoring and evaluation, community empowerment, employment and
          business support. He has been engaged in a wide range of development,
          programming and implementation processes of UN programmes for the last
          20 years both at national and international level. <br /><br />
          Sagitjan worked as WASH Officer for UNICEF Country Office in
          Uzbekistan by managing several UN Joint Programmes in Karakalpakstan,
          focused on improving access to safe drinking water in remote
          communities of Karakalpakstan, improving WASH facilities in 25 schools
          and 36 healthcare facilities and the revision of WASH hardware and
          software standards (2021-2025). <br /><br />
          He was also the Project Manager for UNDP Uzbekistan “Promoting Youth
          Employment in Uzbekistan” on managing youth employment and
          entrepreneurial skills development. He was also a Team Leader on
          Social Services/Monitoring & Evaluation for several UN Joint
          Programmes in Aral Sea region (2013-2014; 2016-2019). <br /><br />
          At international level, Sagitjan served as Planning, Monitoring and
          Evaluation Officer for UN Liberia Resident Coordinator’s Office, where
          he was engaged in coordination of 16 UN agencies during the EVD
          outbreak (2014-2016).
        </p>
      </div>
      <div class="member-box-5 absolute">
        <p class="field">Food</p>
        <div class="profile-box">
          <div class="profile-box-edge">
            <img src="{{ asset('team/Elena.jpg') }}" alt="Team member" id="img-small" />
          </div>
          <img
            src="{{ asset('svg/profile-line.svg') }}"
            alt="profile line"
            class="profile-line"
          />
        </div>
        <div class="profile-desc">
          <p class="leader-name">Elena Kan </p>
        </div>
      </div>
      <div class="team-member-bio-2 absolute margin-top">
        <p>
          Elena Kan is the director of a young NGO “KIVA Center” dedicated to
          advancing sustainable development by integrating science, education,
          research, production, and agribusiness - one of the few civil society
          organizations of its kind in the Aral Sea region. <br /><br />With a
          background in language studies and ecology, Elena has built extensive
          experience in capacity building for efficient land and water use in
          agriculture. Among her current engagements is the promotion of
          effective production and export of alternzative, low-resource oilseed
          crops among farmers and agripreneurs. Elena also collaborates with
          protected areas to enhance their educational programs and eco-tourism
          capacities through non-formal learning on natural resource
          conservation and fostering civic activism for environmental
          protection. She strives to drive positive changes in both urban and
          rural areas, contributing to nature conservation and the resilience of
          local ecosystems and communities through education and collaboration.
        </p>
      </div>
      <div class="member-box-3 absolute-2">
        <div class="profile-box">
          <div class="profile-box-edge">
            <img src="{{ asset('team/Eva.png') }}" alt="Team member" id="img-small" />
          </div>
          <img
            src="{{ asset('svg/profile-line.svg') }}"
            alt="profile line"
            class="profile-line"
          />
        </div>
        <div class="profile-desc">
          <p class="leader-name">Eva Pfannes    </p>
        </div>
      </div>
      <div class="team-member-bio-1 absolute-2">
        <p>
          Eva is a passionate practitioner and frequent key-note speaker who
          thrives working in complex and fast developing environments with
          public sector and cultural clients, focused on the benefits for
          society and the natural environment. She co-founded OOZE architects;
          urbanists with her partner Sylvain Hartenberg in Rotterdam. “OOZE is
          championing a culture of innovation, inclusion and integration:
          radical system thinkers and doers, passionate collaborators leaving no
          one behind, and catalysts’ designers that foster innovative
          interventions for real change, from the smallest community to the
          world” (quote Henk Ovink, 2025). Eva specializes in urban strategies,
          blue-green infrastructure and bankable concept developments that
          mitigate and adapt to climate change impacts with Nature-based and
          Culture-based solutions. For the Dutch Water as Leverage programme,
          she is the team lead for the CITY OF 1000 TANKS alliance in Chennai,
          developing a water balance model across the city to make the most
          inclusive, efficient and economic use of water locally. Água Carioca,
          an urban circulatory system for Brazil, received the Holcim Prize for
          Sustainable Development. As co-curator and lead designer for the
          International Architecture Biennial Rotterdam (IABR) Eva and her team
          developed a neighbourhood energy transition model prioritizing
          community ownership, multi-scalar benefits, and actionable
          implementation frameworks.
        </p>
      </div>
      <div class="member-box-5 absolute-2">
        <div class="profile-box">
          <div class="profile-box-edge">
            <img src="{{ asset('team/Michelle.jpg') }}" alt="Team member" id="img-small" />
          </div>
          <img
            src="{{ asset('svg/profile-line.svg') }}"
            alt="profile line"
            class="profile-line"
          />
        </div>
        <div class="profile-desc">
          <p class="leader-name">Michelle Skelsgaard  </p>
        </div>
      </div>
      <div class="team-member-bio-2 absolute-2">
        <p>
          Michelle is a Danish economic geographer, policy advisor, and project
          manager with a strong focus on sustainable agri-food systems and
          agroecological transformations. She hold an MSc in Geography with a
          specialization in socio-economic transformations, and have extensive
          experience working across civil society, research, and practice. She
          currently work as a food policy advisor at the Danish environmental
          NGO Rådet for Grøn Omstilling (Green Transition Denmark), where she 
          develops and leads projects at the intersection of policy,
          sustainability, and agriculture, including ecological economics, seed
          sovereignty, and grassroots innovation in food and farming systems.
          Her professional background spans research, advisory, and editorial
          roles across multiple countries and contexts. She  co-founded
          interdisciplinary platforms (e.g. The Preserve Journal, KOMPOST
          Studio), all dedicated to the exploration and celebration of
          sustainable food culture, place-based knowledge, and transformative
          storytelling. She is deeply engaged in regional innovation networks
          and participatory learning formats, with a particular interest in the
          regeneration and revitalisation of rural landscapes, practices, and
          communities.
        </p>
      </div>
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
                    <p>{{ $item->translated_title }}</p>
                    <img src="{{ asset('svg/Arrow.svg') }}" alt="Arrow" />
                  </div>

                  <div class="faq-answer">
                    <p>{{ $item->translated_content }}</p>
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
      <div class="about-title overlay-bg-color"><p>About ACDF</p></div>
      <div class="about-box">
        <div class="about-left">
          <p>
            The Aral School is an initiative of the Uzbekistan Art and Culture
            Development Foundation (ACDF).
          </p>
        </div>
        <div class="about-right">
          <p>
            The Uzbekistan Art and Culture Development Foundation (ACDF)
            preserves, promotes and nurtures Uzbekistan’s heritage, arts and
            culture. Positioned at the forefront of Uzbekistan’s cultural
            development, ACDF is committed to fostering the cultural ecosystem
            of the country, driving the creative economy, and providing
            opportunities for practitioners on a local, regional and global
            stage. ACDF believes that culture and heritage are vital in shaping
            society, uniting communities, bridging generations, and facilitating
            cross-cultural conversations. ACDF has successfully led the fourth
            edition of the World Conference on Creative Economy (WCCE) (2-4
            October 2024) in Tashkent and the inaugural Aral Culture Summit (4-6
            April 2025) in Nukus, Karakalpakstan. The Foundation currently
            spearheads Uzbekistan’s participation in Expo 2025 Osaka, Kansai,
            Japan (April – October 2025), the revitalisation of the Centre for
            Contemporary Arts in Tashkent, the construction of the new National
            Museum of Uzbekistan designed by Tadao Ando, and the restoration and
            partial reconstruction of the Palace of the Grand Duke of Romanov.
            ACDF has also launched “Tashkent Modernism XX/XXI”, an ongoing
            research project documenting and protecting the city's modernist
            architecture, highlighted by two significant publications in
            collaboration with Rizzoli New York (published in November 2024) and
            Lars Müller Publishers (published in May 2025). In Bukhara, ACDF is
            launching the first Bukhara Biennial in September 2025.  In
            Samarkand, ACDF will host the forthcoming 43rd session of the UNESCO
            General Conference (30 October - 13 November 2025). To date, ACDF
            has reached over 3.5 million visitors through landmark exhibitions
            across 17 countries: from the Louvre and Arab World Institute in
            Paris to the Uffizi in Florence, the British Museum in London, and
            the Palace Museum in Beijing. With projects presented across Europe,
            Asia, and the Gulf, and collaborations with over 40 international
            museums and cultural institutions, the Foundation is amplifying
            Uzbek voices and stories in the world’s most influential cultural
            arenas.
          </p>
        </div>
      </div>
    </section>
    <section id="footer">
      <div class="top-layer overlay-bg-color"></div>
      <div class="contact">
        <p class="footer-title">contact</p>
        <p class="org-name">
          Uzbekistan Art and Culture Development Foundation
        </p>
        <p class="address">
          Address: 1, Taras Shevchenko str., Tashkent, 100029, Uzbekistan
        </p>
        <p class="phone">Phone: <span>+998 (71) 207 40 80</span> </p>
        <br />
        <p class="footer-title">general inquiries</p>
        <p class="email">info@aralschool.uz</p>
      </div>

      <div class="social-media">
        <p class="footer-title">social media</p>
        <a href="#"> LinkedIn ↗ </a> <br />
        <a href="#"> Instagram ↗ </a>
      </div>
      <div class="logo-footer">
        <img src="{{ asset('logo/ARAL.svg') }}" alt="Aral" id="footer-aral" />
        <img src="{{ asset('logo/SCHOOL.svg') }}" alt="School" id="footer-school" />
        <div class="footer-square"></div>
      </div>
      <div class="email-form overlay-bg-color">
        <p class="footer-title">Newsletter</p>
        <form action="" class="form">
          <input type="email" placeholder="Enter your email" />
          <button type="submit">Subscribe</button>
        </form>
      </div>

      <div class="footer-overlay">
        <div class="footer-banner">
          <img src="{{ asset('svg/ACDF_logo-en 1.svg') }}" alt="ACDF logo" />
        </div>
        <div class="organiser">
          <p>Organiser</p>
          <p>Uzbekistan Art and Culture Development Foundation</p>
        </div>
        <div class="privacy">
          <ul>
            <li><a href="#">Privacy policy</a></li>
            <li><a href="#">Cookie policy</a></li>
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
        // optional: close others
        faqItems.forEach((i) => {
          if (i !== item) i.classList.remove("active");
        });

        item.classList.toggle("active");
      });
    });
  </script>
</html>

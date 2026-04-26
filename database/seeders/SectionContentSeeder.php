<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\SectionContent;
use Illuminate\Database\Seeder;

class SectionContentSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->sections() as $sectionData) {
            $section = Section::firstOrCreate(
                ['type' => $sectionData['type']],
                [
                    'name' => $sectionData['name'],
                    'image' => $sectionData['image'] ?? null,
                    'order' => $sectionData['order'],
                ],
            );

            if (! $section->name) {
                $section->update(['name' => $sectionData['name']]);
            }

            if (! $section->image && ! empty($sectionData['image'])) {
                $section->update(['image' => $sectionData['image']]);
            }

            foreach ($sectionData['contents'] as $contentData) {
                SectionContent::firstOrCreate(
                    [
                        'section_id' => $section->id,
                        'key' => $contentData['key'],
                    ],
                    [
                        'kind' => $contentData['kind'],
                        'title' => $contentData['title'] ?? null,
                        'content' => $contentData['content'] ?? null,
                        'image' => $contentData['image'] ?? null,
                        'extra' => $contentData['extra'] ?? null,
                        'order' => $contentData['order'],
                    ],
                );
            }
        }
    }

    protected function sections(): array
    {
        return [
            [
                'type' => 'intro',
                'name' => 'Intro',
                'order' => 20,
                'contents' => [
                    [
                        'key' => 'intro-label',
                        'kind' => 'content',
                        'title' => 'Aral School',
                        'order' => 10,
                    ],
                    [
                        'key' => 'intro-body',
                        'kind' => 'rich_text',
                        'content' => 'We are pleased to announce the Aral School, the new education programme beginning in 2026, led by Jan Boelen and commissioned by the Uzbekistan Art and Culture Development Foundation.',
                        'order' => 20,
                    ],
                    [
                        'key' => 'intro-cta',
                        'kind' => 'cta',
                        'title' => 'Apply now',
                        'content' => 'Deadline 5th of October 2025',
                        'order' => 30,
                    ],
                ],
            ],
            [
                'type' => 'climate',
                'name' => 'Climate',
                'image' => 'gallery/aral_photo.jpg',
                'order' => 30,
                'contents' => [
                    [
                        'key' => 'climate-body',
                        'kind' => 'rich_text',
                        'content' => <<<HTML
The climate crisis is leaving an indelible mark on our ecosystems and bioregions, forcing us to rethink our interdependencies and alliances. North Uzbekistan and the Karakalpakstan area were once home to the vast Aral Sea, a lake in Central Asia that was for most of the 20th century the world's fourth largest saline lake. In the last fifty years, the lake has dramatically dried up, with a radical increase in salinisation, primarily due to unsustainable irrigation practices linked to intensive, large-scale cotton cultivation. The consequences have irreversibly altered a bioregion and caused the collapse of an ecosystem, with serious impact on local communities and the region's ecology, economy, culture, and public health.<br><br>The Aral School is an interdisciplinary postgraduate programme that recognises the unique characteristics of this context, as well as the dramatic consequences of this ecosystem's collapse. In a lucid approach, the school takes these as the starting point to create new and sustainable visions and prototypes for a shared future. The programme brings together international and local participants from Uzbekistan and Karakalpakstan to explore innovative solutions for cultural and ecological regeneration. Learning from the traditions, biocultural context, and environmental pressure of the Karakalpakstan region, the programme fosters new ways of learning and collaborating across disciplines.
HTML,
                        'order' => 10,
                    ],
                ],
            ],
            [
                'type' => 'programme_vision',
                'name' => 'Programme Vision',
                'order' => 40,
                'contents' => [
                    [
                        'key' => 'section-heading',
                        'kind' => 'section_heading',
                        'title' => 'Programme <br /> vision',
                        'order' => 10,
                    ],
                    [
                        'key' => 'programme-vision-about',
                        'kind' => 'feature_card',
                        'title' => 'About',
                        'content' => 'The Aral School wants to connect a new generation of design practitioners, and position Uzbekistan as a global laboratory of the future. Working from the Aral Sea region context, the initiative promotes regenerative practices, stimulates new ways of learning and collaborating, and learns from local know-how, communities and stakeholders. The postgraduate programme brings together twenty participants per year, each cohort contributing to create a growing global community around themes of sustainability and regeneration. With a yearly programme of events around the globe, including a presentation at the Milan Design Week 2026 and the Aral Culture Summit later on in October 2026, the Aral School becomes a global platform for knowledge exchange on ecological restoration and sustainability.',
                        'image' => 'gallery/about_photo.jpg',
                        'order' => 20,
                    ],
                    [
                        'key' => 'programme-vision-goals',
                        'kind' => 'feature_card',
                        'title' => 'Goals',
                        'content' => 'The Aral School aims to build a long-term, bioregional learning platform rooted in the Aral Sea region. It seeks to support a new generation of practitioners, connect local and international knowledge, and create a durable network around ecology, culture, and regenerative design. Each cohort contributes to a wider community of practice that extends far beyond the programme itself.',
                        'image' => 'gallery/goals.jpg',
                        'order' => 30,
                    ],
                    [
                        'key' => 'programme-vision-image-one',
                        'kind' => 'media',
                        'image' => 'gallery/programme-image-one.png',
                        'order' => 40,
                    ],
                    [
                        'key' => 'programme-vision-mission',
                        'kind' => 'feature_card',
                        'title' => 'Mission',
                        'content' => 'The Aral School mission is to turn a site of ecological urgency into a site of collective imagination, research, and experimentation. Through postgraduate education, international exchange, and grounded regional collaboration, the programme develops prototypes, methods, and stories that can contribute to ecological restoration and new sustainable futures.<br><br>The school brings together participants from different disciplines and geographies, learning from local knowledge while developing globally relevant approaches to regeneration, sustainability, and cultural production.',
                        'image' => 'gallery/mission.jpg',
                        'order' => 50,
                    ],
                    [
                        'key' => 'programme-vision-image-two',
                        'kind' => 'media',
                        'image' => 'gallery/programme-image-two.jpg',
                        'order' => 60,
                    ],
                ],
            ],
            [
                'type' => 'research',
                'name' => 'Research',
                'order' => 50,
                'contents' => [
                    [
                        'key' => 'section-heading',
                        'kind' => 'section_heading',
                        'title' => 'Core research themes',
                        'order' => 10,
                    ],
                    [
                        'key' => 'research-body',
                        'kind' => 'rich_text',
                        'content' => 'The two first themes of the Aral School Pilot examine food and water. Two interconnected research topics that are influencing the way we produce and consume food, our livelihood and global biodiversity. We need to develop and speculate new strategies and design new systems to prototype possible futures in order to inspire, building hope. The topics are at the same time our alibi and point of departure to introduce holistic eco-systemic projects that would build a new bioregion from molecular to bioregional scale.',
                        'order' => 20,
                    ],
                    [
                        'key' => 'research-theme-food',
                        'kind' => 'feature_card',
                        'title' => 'The Food System <br />of the Aral region',
                        'content' => 'When ecological systems are changing or collapsing, agriculture needs to adapt. What kind of sustainable food systems in Karakalpakstan and the Aral Sea region at a larger scale can we develop? New agroecological approaches in the city of Nukus and beyond will be explored and developed, creating a sustainable framework for a resilient and equitable future.',
                        'image' => 'gallery/food.jpg',
                        'extra' => ['number' => '1'],
                        'order' => 30,
                    ],
                    [
                        'key' => 'research-theme-water',
                        'kind' => 'feature_card',
                        'title' => 'Water of the Aral <br />region',
                        'content' => 'In the region where water evaporated by human activities, we want to bring back water in everyday life to increase quality of life. As a new benchmark for the water ecosystem, this theme explores opportunities, partnerships, tools, and collaborations that can reshape the future of the region through new water ethics and principles of bioregional design.',
                        'image' => 'gallery/aral_water.jpg',
                        'extra' => ['number' => '2'],
                        'order' => 40,
                    ],
                ],
            ],
            [
                'type' => 'programme_outcomes',
                'name' => 'Programme Outcomes',
                'order' => 60,
                'contents' => [
                    [
                        'key' => 'section-heading',
                        'kind' => 'section_heading',
                        'title' => 'Programme <br /> outcomes',
                        'order' => 10,
                    ],
                    [
                        'key' => 'programme-outcome-1',
                        'kind' => 'list_item',
                        'content' => 'Design prototypes connected to the core themes developed within the research groups.',
                        'order' => 20,
                    ],
                    [
                        'key' => 'programme-outcome-2',
                        'kind' => 'list_item',
                        'content' => 'A media publication capturing the process, key research questions, and prototype solutions will be published within 2026.',
                        'order' => 30,
                    ],
                    [
                        'key' => 'programme-outcome-3',
                        'kind' => 'list_item',
                        'content' => 'First ideas will be shared with the global creative public during Milan Design Week 2026 and Aral Culture Summit 2026, and additional cultural outposts for the prototypes exhibition might also take place.',
                        'order' => 40,
                    ],
                    [
                        'key' => 'programme-outcome-4',
                        'kind' => 'list_item',
                        'content' => 'Key research outcomes and ideas will be shared in an exhibition and publication during the second Aral Culture Summit in October 2026 as part of the programme.',
                        'order' => 50,
                    ],
                ],
            ],
            [
                'type' => 'apply',
                'name' => 'Apply',
                'image' => 'gallery/apply-image.jpg',
                'order' => 70,
                'contents' => [
                    [
                        'key' => 'section-heading',
                        'kind' => 'section_heading',
                        'title' => 'Who can apply',
                        'order' => 10,
                    ],
                    [
                        'key' => 'apply-body',
                        'kind' => 'rich_text',
                        'content' => 'The multidisciplinary programme is aimed at young professionals from Uzbekistan and abroad with varied backgrounds and work experience in the fields of architecture, urbanism, environmental science, biotech, climate studies, filmmaking, media, crafts, design, computer technologies, social studies, physical sciences, and other fields.<br><br>It is recommended that applicants to the programme have a higher education diploma, in any specialisation, and no less than 2-3 years of work experience.<br><br>When reviewing applications, we focus on how potential researchers could apply their expertise to the research agenda of the programme and current theme.',
                        'order' => 20,
                    ],
                    [
                        'key' => 'apply-cta',
                        'kind' => 'cta',
                        'title' => 'Apply now',
                        'content' => 'Deadline 5th of October 2025',
                        'order' => 30,
                    ],
                    [
                        'key' => 'apply-benefits-title',
                        'kind' => 'content',
                        'title' => 'What is in it for applicants?',
                        'order' => 40,
                    ],
                    [
                        'key' => 'apply-benefit-item-1',
                        'kind' => 'list_item',
                        'content' => 'No tuition fee',
                        'order' => 41,
                    ],
                    [
                        'key' => 'apply-benefit-item-2',
                        'kind' => 'list_item',
                        'content' => 'Prototyping, material costs, research trips and accommodation are included',
                        'order' => 42,
                    ],
                    [
                        'key' => 'apply-benefit-item-3',
                        'kind' => 'list_item',
                        'content' => 'Monthly participation stipend',
                        'order' => 43,
                    ],
                    [
                        'key' => 'apply-benefit-item-4',
                        'kind' => 'list_item',
                        'content' => 'Visibility and exposure to global and local creative network',
                        'order' => 44,
                    ],
                    [
                        'key' => 'apply-benefit-item-5',
                        'kind' => 'list_item',
                        'content' => 'Contact with international experts on a one-to-one basis',
                        'order' => 45,
                    ],
                    [
                        'key' => 'apply-benefit-item-6',
                        'kind' => 'list_item',
                        'content' => 'Publication of the cohort developments and outcome in a respective print format',
                        'order' => 46,
                    ],
                    [
                        'key' => 'apply-benefit-item-7',
                        'kind' => 'list_item',
                        'content' => 'A growing cohort of Aral School alumni who remain connected in the future',
                        'order' => 47,
                    ],
                    [
                        'key' => 'apply-requirements-title',
                        'kind' => 'content',
                        'title' => 'Application Requirements',
                        'order' => 50,
                    ],
                    [
                        'key' => 'apply-requirement-item-1',
                        'kind' => 'list_item',
                        'content' => 'Completed higher education',
                        'order' => 51,
                    ],
                    [
                        'key' => 'apply-requirement-item-2',
                        'kind' => 'list_item',
                        'content' => '2-3 years of work experience',
                        'order' => 52,
                    ],
                    [
                        'key' => 'apply-requirement-item-3',
                        'kind' => 'list_item',
                        'content' => 'Fluency in English',
                        'order' => 53,
                    ],
                    [
                        'key' => 'apply-requirement-item-4',
                        'kind' => 'list_item',
                        'content' => 'High level of motivation and self-organisation',
                        'order' => 54,
                    ],
                    [
                        'key' => 'apply-selection',
                        'kind' => 'content',
                        'title' => 'Selection Process',
                        'content' => 'Upon applications and portfolio review, selected candidates will be invited for a creative interview session to share their areas of interest and motivations.',
                        'order' => 60,
                    ],
                    [
                        'key' => 'apply-documents-title',
                        'kind' => 'content',
                        'title' => 'Required documents',
                        'order' => 70,
                    ],
                    [
                        'key' => 'apply-documents-form-label',
                        'kind' => 'content',
                        'content' => 'Completed online application form',
                        'order' => 71,
                    ],
                    [
                        'key' => 'apply-documents-note',
                        'kind' => 'rich_text',
                        'content' => 'Please submit the following documents together with your application:',
                        'order' => 72,
                    ],
                    [
                        'key' => 'apply-document-item-1',
                        'kind' => 'list_item',
                        'content' => 'CV and creative portfolio in PDF format, not exceeding a total of 10 pages and 5 projects. The portfolio should contain examples of projects and or research work completed in the last few years and demonstrate your skills, expertise, and interest in the programme themes. Please embed any video material within the PDF.',
                        'order' => 73,
                    ],
                    [
                        'key' => 'apply-document-item-2',
                        'kind' => 'list_item',
                        'content' => 'Copy of a university diploma',
                        'order' => 74,
                    ],
                    [
                        'key' => 'apply-document-item-3',
                        'kind' => 'list_item',
                        'content' => 'Motivation letter explaining in no more than 600 words why you are interested in the programme and how it connects to your area of research or practice',
                        'order' => 75,
                    ],
                    [
                        'key' => 'apply-document-item-4',
                        'kind' => 'list_item',
                        'content' => 'Passport photo page scan',
                        'order' => 76,
                    ],
                    [
                        'key' => 'apply-documents-footer-note',
                        'kind' => 'rich_text',
                        'content' => 'Please note, only fully completed applications as per the list above will be considered.',
                        'order' => 77,
                    ],
                ],
            ],
            [
                'type' => 'team',
                'name' => 'Team',
                'order' => 80,
                'contents' => [
                    [
                        'key' => 'section-heading',
                        'kind' => 'section_heading',
                        'title' => 'The team',
                        'order' => 10,
                    ],
                    [
                        'key' => 'team-chair',
                        'kind' => 'person',
                        'title' => 'Gayane Umerova',
                        'image' => 'team/team_lead.jpg',
                        'extra' => ['role' => 'Project Chair'],
                        'order' => 20,
                    ],
                    [
                        'key' => 'team-chair-bio-left',
                        'kind' => 'rich_text',
                        'content' => 'Gayane Umerova is dedicated to developing the culture sector in Uzbekistan.<br><br>Head of the Department of Creative Economy and Tourism of the Administration of the President of the Republic of Uzbekistan and Chairperson of the Uzbekistan Art and Culture Development Foundation (ACDF), Gayane Umerova is at the helm of building Uzbekistan\'s cultural infrastructure. Her efforts are bringing the nation\'s art, artists, and cultural heritage into the global spotlight. Currently, she is overseeing the restoration and development of the Centre for Contemporary Arts in Tashkent, poised to become a new cultural hub for the region, and is the commissioner of the Bukhara Biennial (5 September - 20 November 2025). She has spearheaded the inaugural Aral Culture Summit (April 4-6, 2025); is driving the construction of the new Uzbekistan National Museum designed by Tadao Ando; and is leading the forthcoming 43rd session of the UNESCO General Conference that will take place in Samarkand on 30 October - 13 November 2025. She is the commissioner for the Uzbekistan Pavilion at the Venice Biennale Arte and Architettura since 2021 as well as for Uzbekistan\'s participation in Expo 2025 Osaka, among other significant projects.',
                        'order' => 21,
                    ],
                    [
                        'key' => 'team-chair-bio-right',
                        'kind' => 'rich_text',
                        'content' => 'Committed to boosting Uzbekistan\'s prominence on the international culture scene, Umerova serves as the Chairperson of the National Commission of Uzbekistan on UNESCO Affairs under the Cabinet of Ministers and in April 2025 was awarded France\'s Order of Arts and Literature. Her public service commitment is evident in her dedication to creating opportunities for young people in Uzbekistan\'s cultural sector and fostering a cultural economy that unites communities and generations.',
                        'order' => 22,
                    ],
                    [
                        'key' => 'team-director',
                        'kind' => 'person',
                        'title' => 'Jan Boelen',
                        'content' => 'Jan Boelen is a curator of design, architecture, and contemporary art. He is the artistic director of Atelier LUMA, an experimental laboratory for design in Arles, France. Boelen studied Product Design at Genk and is the founder and former artistic director of Z33 - House for contemporary art in Hasselt, Belgium. He was founder of the Master Social Design at the Design Academy of Eindhoven till 2020 and Rektor of the Karlsruhe University of Arts and Design from 2019 till 2023. In 2014 he curated BIO50, the design biennial of Ljubljana in Slovenia. He was curator of the 4th Istanbul Design Biennial in Istanbul (2018) and initiated Manifesta 9 in Belgium (2012). Lastly, Boelen curated the Lithuanian Pavilion Planet of People in the Venice Architecture Biennial (2021).<br><br>Over the years he has been fashioning projects and exhibitions that encourage the visitor to look at everyday objects in a novel manner.<br><br>Boelen recently edited Social Matter, Social Design: For Good or Bad, all Design is Social (Valiz, 2020), and Muller Van Severen: Dialogue (Walther Koenig, 2021) and Atelier Luma, Bioregional design practices (Luma, 2023). His writing addresses the implications of design in everyday life and how artistic practices can shape the discipline.',
                        'image' => 'team/Jan.jpg',
                        'extra' => ['role' => 'Project Director'],
                        'order' => 30,
                    ],
                    [
                        'key' => 'team-program-lead',
                        'kind' => 'person',
                        'title' => 'Ksenia Starikova-Pozzoli',
                        'content' => 'Ksenia is a design curator and creative strategist with a focus on circular innovations and regenerative placemaking. A London School of Economics and Stanford graduate, she brings over 15 years of creative leadership and programme management across a variety of impact-driven brands, sectors, and organisations. A journalist by background, she gradually centered her thinking at the intersection of science, design, and new technologies, leading one of WPP design and innovation practices in London and New York City.<br><br>Her subsequent brand leadership of the iconic Design Hotels platform allowed for a greater focus on the topics of community, impact, and sustainability and led to her authorship of the first regenerative placemaking framework in travel, widely adopted by the industry since then across the globe.<br><br>Driven by her interests in sustainable design practices, Ksenia now runs her own design studio, working with impact and climate-driven ventures and organisations on their content, programming, and community initiatives.<br><br>She is also a curator of the largest climate tech festival in the UK, The Heat, and is focused on supporting a diverse range of pioneering bio-design innovations in fashion, design, and architecture as part of it.',
                        'image' => 'team/Ksenia.png',
                        'extra' => ['role' => 'Program Lead'],
                        'order' => 40,
                    ],
                    [
                        'key' => 'team-project-manager',
                        'kind' => 'person',
                        'title' => 'Khudoyorkhon Abdujabborov',
                        'content' => 'Khudoyorkhon Abdujabborov is a project manager at the Aral School, responsible for coordinating partnerships, exhibitions, and local implementation across Karakalpakstan. He brings extensive experience in international cultural collaboration, having managed key initiatives for the Uzbekistan Art and Culture Development Foundation, including the exhibition "A Glimpse Through Time: The Legacy of Khudaybergen Devanov" at UNESCO in Paris and the redevelopment of the permanent collection at the State Museum of Arts named after I.V. Savitsky in Nukus. Prior to this, he worked in diplomatic and cultural roles at the Embassy of Poland in Uzbekistan and the El-Yurt Umidi Foundation. He holds a degree in International Relations from Kazan Federal University and is also a laureate of an international circus arts festival, with performance experience in Uzbekistan, Mexico, and the USA.',
                        'image' => 'team/Khan.png',
                        'extra' => ['role' => 'Project Manager'],
                        'order' => 50,
                    ],
                    [
                        'key' => 'team-local-coordinator',
                        'kind' => 'person',
                        'title' => 'Gulnara Joldasbaeva',
                        'content' => 'Gulnara Joldasbaeva is a cultural producer, educator, and local coordinator of the Aral Culture Summit in Karakalpakstan. She curates interdisciplinary events connecting ecology, heritage, and contemporary art. As part of the School, she brings together artists, scientists, and community members to reflect on the Aral Sea crisis through creative formats. In partnership with UNDP, she also launched Bilim, a platform offering programming and language education to young women in underrepresented communities. Her experience in ecological education and local cultural engagement makes her an essential link between artistic content and regional relevance.',
                        'image' => 'team/Gulnara.jpg',
                        'extra' => ['role' => 'Local Coordinator'],
                        'order' => 60,
                    ],
                    [
                        'key' => 'team-advisor',
                        'kind' => 'person',
                        'title' => 'Cyril <br />Zammit',
                        'content' => 'Cyril Zammit is an independent advisor and design consultant, with a career devoted to supporting cultural and creative initiatives across the Middle East and Central Asia.<br><br>He began his professional journey at the Institut Francais in Prague, followed by a role at the Cultural Department of the French Embassy in London. He later moved to Switzerland, where he oversaw international sponsorship for the Montreux Jazz Festival, before taking on cultural sponsorship roles at UBS and HSBC Private Bank.<br><br>In 2009, Cyril relocated to the UAE, where he played a key role in launching Abu Dhabi Art, and went on to establish Design Days Dubai and Dubai Design Week. He later served as an advisor to Dubai Culture & Arts Authority, and subsequently joined the UAE Ministry of Foreign Affairs & International Cooperation as a Cultural Affairs Expert in the Office of Public and Cultural Diplomacy.<br><br>Since March 2022, he has been advising the Uzbekistan Art and Culture Development Foundation. In 2023, he also became an advisor to L\'ECOLE Middle East in Dubai and was appointed Design Consultant to the Royal Commission for AlUla. Cyril is also a regular design columnist for Esquire Middle East.',
                        'image' => 'team/Cyril.jpg',
                        'extra' => ['role' => 'Advisor'],
                        'order' => 70,
                    ],
                    [
                        'key' => 'team-research-development',
                        'kind' => 'person',
                        'title' => 'Anastasia <br />Sinitsyna',
                        'content' => 'Anastasia Sinitsyna is a researcher and cultural consultant working at the intersection of environmental humanities, design, and education. She is currently based in Venice, Italy, where she coordinates international exhibitions and cultural initiatives, including the Spanish (2023) and Uzbekistan (2022-2025) National Pavilions at the Venice Biennale. Her work focuses on ecological transformation, sustainable futures, and the role of art and education in reimagining cultural and physical landscapes.<br><br>Anastasia also leads research and programming for the Aral Culture Summit, a long-term initiative of ACDF aimed at supporting biocultural diversity and ecological regeneration in Karakalpakstan and the broader Aral Sea region.',
                        'image' => 'team/Anastasia.jpg',
                        'extra' => ['role' => 'Research & Development'],
                        'order' => 80,
                    ],
                ],
            ],
            [
                'type' => 'mentors',
                'name' => 'Mentors',
                'order' => 90,
                'contents' => [
                    [
                        'key' => 'section-heading',
                        'kind' => 'section_heading',
                        'title' => 'Mentors & Experts',
                        'order' => 10,
                    ],
                    [
                        'key' => 'mentor-sagit',
                        'kind' => 'person',
                        'title' => 'Sagitjan Aytjanov',
                        'content' => 'Sagitjan has a profound experience in the field of complex projects management with technical expertise in programs planning, management, monitoring and evaluation, community empowerment, employment and business support. He has been engaged in a wide range of development, programming, and implementation processes of UN programmes for the last 20 years both at national and international level.<br><br>Sagitjan worked as WASH Officer for UNICEF Country Office in Uzbekistan by managing several UN Joint Programmes in Karakalpakstan, focused on improving access to safe drinking water in remote communities of Karakalpakstan, improving WASH facilities in 25 schools and 36 healthcare facilities, and the revision of WASH hardware and software standards (2021-2025).<br><br>He was also the Project Manager for UNDP Uzbekistan "Promoting Youth Employment in Uzbekistan" on managing youth employment and entrepreneurial skills development. He was also a Team Leader on Social Services and Monitoring & Evaluation for several UN Joint Programmes in the Aral Sea region (2013-2014; 2016-2019).<br><br>At international level, Sagitjan served as Planning, Monitoring and Evaluation Officer for UN Liberia Resident Coordinator\'s Office, where he was engaged in coordination of 16 UN agencies during the EVD outbreak (2014-2016).',
                        'image' => 'team/Sagit.png',
                        'extra' => ['field' => 'Water'],
                        'order' => 20,
                    ],
                    [
                        'key' => 'mentor-elena',
                        'kind' => 'person',
                        'title' => 'Elena Kan',
                        'content' => 'Elena Kan is the director of a young NGO "KIVA Center" dedicated to advancing sustainable development by integrating science, education, research, production, and agribusiness - one of the few civil society organizations of its kind in the Aral Sea region.<br><br>With a background in language studies and ecology, Elena has built extensive experience in capacity building for efficient land and water use in agriculture. Among her current engagements is the promotion of effective production and export of alternative, low-resource oilseed crops among farmers and agripreneurs. Elena also collaborates with protected areas to enhance their educational programs and eco-tourism capacities through non-formal learning on natural resource conservation and fostering civic activism for environmental protection. She strives to drive positive changes in both urban and rural areas, contributing to nature conservation and the resilience of local ecosystems and communities through education and collaboration.',
                        'image' => 'team/Elena.jpg',
                        'extra' => ['field' => 'Food'],
                        'order' => 30,
                    ],
                    [
                        'key' => 'mentor-eva',
                        'kind' => 'person',
                        'title' => 'Eva Pfannes',
                        'content' => 'Eva is a passionate practitioner and frequent keynote speaker who thrives working in complex and fast-developing environments with public sector and cultural clients, focused on benefits for society and the natural environment. She co-founded OOZE architects and urbanists with her partner Sylvain Hartenberg in Rotterdam. OOZE champions a culture of innovation, inclusion, and integration: radical system thinkers and doers, passionate collaborators leaving no one behind, and catalytic designers that foster innovative interventions for real change, from the smallest community to the world.<br><br>Eva specializes in urban strategies, blue-green infrastructure, and bankable concept developments that mitigate and adapt to climate change impacts with nature-based and culture-based solutions. For the Dutch Water as Leverage programme, she is the team lead for the CITY OF 1000 TANKS alliance in Chennai, developing a water balance model across the city to make the most inclusive, efficient, and economic use of water locally. Agua Carioca, an urban circulatory system for Brazil, received the Holcim Prize for Sustainable Development. As co-curator and lead designer for the International Architecture Biennial Rotterdam (IABR), Eva and her team developed a neighbourhood energy transition model prioritizing community ownership, multi-scalar benefits, and actionable implementation frameworks.',
                        'image' => 'team/Eva.png',
                        'order' => 40,
                    ],
                    [
                        'key' => 'mentor-michelle',
                        'kind' => 'person',
                        'title' => 'Michelle Skelsgaard',
                        'content' => 'Michelle is a Danish economic geographer, policy advisor, and project manager with a strong focus on sustainable agri-food systems and agroecological transformations. She holds an MSc in Geography with a specialization in socio-economic transformations, and has extensive experience working across civil society, research, and practice. She currently works as a food policy advisor at the Danish environmental NGO Radet for Gron Omstilling (Green Transition Denmark), where she develops and leads projects at the intersection of policy, sustainability, and agriculture, including ecological economics, seed sovereignty, and grassroots innovation in food and farming systems.<br><br>Her professional background spans research, advisory, and editorial roles across multiple countries and contexts. She co-founded interdisciplinary platforms such as The Preserve Journal and KOMPOST Studio, dedicated to the exploration and celebration of sustainable food culture, place-based knowledge, and transformative storytelling. She is deeply engaged in regional innovation networks and participatory learning formats, with a particular interest in the regeneration and revitalisation of rural landscapes, practices, and communities.',
                        'image' => 'team/Michelle.jpg',
                        'order' => 50,
                    ],
                ],
            ],
            [
                'type' => 'about',
                'name' => 'About',
                'order' => 110,
                'contents' => [
                    [
                        'key' => 'section-heading',
                        'kind' => 'section_heading',
                        'title' => 'About ACDF',
                        'order' => 10,
                    ],
                    [
                        'key' => 'about-intro',
                        'kind' => 'rich_text',
                        'content' => 'The Aral School is an initiative of the Uzbekistan Art and Culture Development Foundation (ACDF).',
                        'order' => 20,
                    ],
                    [
                        'key' => 'about-body',
                        'kind' => 'rich_text',
                        'content' => 'The Uzbekistan Art and Culture Development Foundation (ACDF) preserves, promotes, and nurtures Uzbekistan\'s heritage, arts, and culture. Positioned at the forefront of Uzbekistan\'s cultural development, ACDF is committed to fostering the cultural ecosystem of the country, driving the creative economy, and providing opportunities for practitioners on a local, regional, and global stage. ACDF believes that culture and heritage are vital in shaping society, uniting communities, bridging generations, and facilitating cross-cultural conversations. ACDF has successfully led the fourth edition of the World Conference on Creative Economy (WCCE) (2-4 October 2024) in Tashkent and the inaugural Aral Culture Summit (4-6 April 2025) in Nukus, Karakalpakstan. The Foundation currently spearheads Uzbekistan\'s participation in Expo 2025 Osaka, Kansai, Japan (April-October 2025), the revitalisation of the Centre for Contemporary Arts in Tashkent, the construction of the new National Museum of Uzbekistan designed by Tadao Ando, and the restoration and partial reconstruction of the Palace of the Grand Duke of Romanov. ACDF has also launched "Tashkent Modernism XX/XXI", an ongoing research project documenting and protecting the city\'s modernist architecture, highlighted by two significant publications in collaboration with Rizzoli New York and Lars Muller Publishers. In Bukhara, ACDF is launching the first Bukhara Biennial in September 2025. In Samarkand, ACDF will host the forthcoming 43rd session of the UNESCO General Conference (30 October - 13 November 2025). To date, ACDF has reached over 3.5 million visitors through landmark exhibitions across 17 countries: from the Louvre and Arab World Institute in Paris to the Uffizi in Florence, the British Museum in London, and the Palace Museum in Beijing. With projects presented across Europe, Asia, and the Gulf, and collaborations with over 40 international museums and cultural institutions, the Foundation is amplifying Uzbek voices and stories in the world\'s most influential cultural arenas.',
                        'order' => 30,
                    ],
                ],
            ],
            [
                'type' => 'footer',
                'name' => 'Footer',
                'order' => 120,
                'contents' => [
                    [
                        'key' => 'footer-contact-heading',
                        'kind' => 'content',
                        'title' => 'contact',
                        'order' => 10,
                    ],
                    [
                        'key' => 'footer-organisation',
                        'kind' => 'content',
                        'content' => 'Uzbekistan Art and Culture Development Foundation',
                        'order' => 20,
                    ],
                    [
                        'key' => 'footer-address',
                        'kind' => 'content',
                        'content' => 'Address: 1, Taras Shevchenko str., Tashkent, 100029, Uzbekistan',
                        'order' => 30,
                    ],
                    [
                        'key' => 'footer-phone',
                        'kind' => 'content',
                        'title' => 'Phone:',
                        'content' => '+998 (71) 207 40 80',
                        'order' => 40,
                    ],
                    [
                        'key' => 'footer-inquiries-heading',
                        'kind' => 'content',
                        'title' => 'general inquiries',
                        'order' => 50,
                    ],
                    [
                        'key' => 'footer-email',
                        'kind' => 'content',
                        'content' => 'info@aralschool.uz',
                        'order' => 60,
                    ],
                    [
                        'key' => 'footer-social-heading',
                        'kind' => 'content',
                        'title' => 'social media',
                        'order' => 70,
                    ],
                    [
                        'key' => 'footer-linkedin',
                        'kind' => 'link',
                        'title' => 'LinkedIn',
                        'content' => '#',
                        'order' => 71,
                    ],
                    [
                        'key' => 'footer-instagram',
                        'kind' => 'link',
                        'title' => 'Instagram',
                        'content' => '#',
                        'order' => 72,
                    ],
                    [
                        'key' => 'footer-newsletter-heading',
                        'kind' => 'content',
                        'title' => 'Newsletter',
                        'order' => 80,
                    ],
                    [
                        'key' => 'footer-newsletter-placeholder',
                        'kind' => 'content',
                        'content' => 'Enter your email',
                        'order' => 81,
                    ],
                    [
                        'key' => 'footer-newsletter-button',
                        'kind' => 'content',
                        'content' => 'Subscribe',
                        'order' => 82,
                    ],
                    [
                        'key' => 'footer-organiser-heading',
                        'kind' => 'content',
                        'title' => 'Organiser',
                        'order' => 90,
                    ],
                    [
                        'key' => 'footer-organiser-body',
                        'kind' => 'content',
                        'content' => 'Uzbekistan Art and Culture Development Foundation',
                        'order' => 91,
                    ],
                    [
                        'key' => 'footer-privacy-link',
                        'kind' => 'link',
                        'title' => 'Privacy policy',
                        'content' => '#',
                        'order' => 100,
                    ],
                    [
                        'key' => 'footer-cookie-link',
                        'kind' => 'link',
                        'title' => 'Cookie policy',
                        'content' => '#',
                        'order' => 101,
                    ],
                ],
            ],
        ];
    }
}

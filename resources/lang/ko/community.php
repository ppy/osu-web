<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

return [
    'support' => [
        'header' => [
            // size in font-size
            'big_description' => 'osu!가 마음에 드셨나요?<br/>
                                osu! 개발진을 지원해주세요 :D',
            'small_description' => '',
            'support_button' => 'osu를 지원하고 싶습니다!',
        ],

        'dev_quote' => 'osu!는 완전한 무료 게임입니다, 하지만 osu!를 운영하는 데에는 돈이 들죠. 서버 운용비와 고품질의 네트워크 환경부터 시작해서 시스템과 커뮤니티를 유지/보수하며 쓰는 시간, 각종 대회에 내걸 보상, 사용자들의 질문에 답변을 하는 등 여러분들을 만족시키기 위해 꽤 많은 돈을 소비하거든요! 아, 저희가 이 모든 서비스를 아무런 광고수익이나 지저분한 툴바를 깔으라는 등의 파트너십 없이 제공해드린다는 점도 포함해서요!
            <br/><br/>결국 가장 중요한 점은 osu!는 거의 제 스스로 운영해오고 있었다는 것이죠, 여러분이 제일 잘 아시는 "peppy"가요.
            저는 osu!를 유지하기 위해 직장을 그만둬야 했고,
            제가 정말 원하던 기준을 유지하기 위해 힘겨운 시간을 보냈습니다.
            지금까지 osu!를 지원해주신 분들께 개인적인 감사를 표하고 싶습니다.
            앞으로 이 멋진 게임과 커뮤니티에 계속해서 지원해주실 분들도 마찬가지로 말이죠 :).',

        'why_support' => [
            'title' => '왜 osu!를 지원해야 하나요?',
            'blocks' => [
                'dev' => '호주에 사는 한 명의 남성에 의해 대부분의 시스템이 개발 및 유지/보수됩니다.',
                'time' => 'osu!를 운영하는 데에만 많은 시간을 쓰고 있어서 이젠 "취미"라고 부를 수도 없는 지경이죠.',
                'ads' => '어디에도 광고는 없습니다. <br/><br/>
                        99.95%의 다른 웹과는 다르게, 수익을위해 여러분한테 광고를 들이밀지는 않습니다.',
                'goodies' => '서포터만을 위한 추가 기능도 준비되어 있어요!',
            ],
        ],

        'perks' => [
            'title' => '오? 뭘 받을 수 있나요?!',
            'osu_direct' => [
                'title' => 'osu!다이렉트',
                'description' => '게임 밖에서 비트맵을 찾을 필요 없이, 게임 내에서 쉽고 빠르게 다운로드 받을 수 있습니다.',
            ],

            'auto_downloads' => [
                'title' => '자동 다운로드',
                'description' => '멀티플레이, 관전, 채팅에 올라온 링크를 누를 때 자동으로 비트맵을 다운로드합니다!',
            ],

            'upload_more' => [
                'title' => '업로드 제한 감소',
                'description' => '최대 10개 까지 (Ranked된 비트맵 당) 추가적인 Pending상태의 비트맵을 업로드할 수 있습니다.',
            ],

            'early_access' => [
                'title' => '미리 해보기',
                'description' => 'osu!에 새 기능을 패치하기 전에, 미리 기능을 체험해볼 수 있습니다!',
            ],

            'customisation' => [
                'title' => '커스터마이징',
                'description' => '여러분의 유저 페이지를 원하는 기호에 맞게 수정할 수 있습니다.',
            ],

            'beatmap_filters' => [
                'title' => '비트맵 필터',
                'description' => '비트맵을 플레이한 맵, 플레이하지 않은 맵, 점수가 등록된 맵을 기준으로 필터링하여 검색할 수 있습니다.',
            ],

            'yellow_fellow' => [
                'title' => '노란색 이름 태그',
                'description' => '게임 내에서 여러분의 유저이름이 노란색으로 표시되어 자신이 서포터임을 과시합니다.',
            ],

            'speedy_downloads' => [
                'title' => '빠른 다운로드',
                'description' => '비트맵 다운로드에 대한 제한이 느슨해집니다, 특히 osu!다이렉트를 사용할 때에는요.',
            ],

            'change_username' => [
                'title' => '유저이름 변경',
                'description' => '추가 비용없이 유저이름을 바꿀 수 있습니다. (1회 한정)',
            ],

            'skinnables' => [
                'title' => '추가 스킨 사용',
                'description' => '메인 메뉴 배경 변경과 같은, 추가적인 게임 내 스킨을 사용할 수 있습니다.',
            ],

            'feature_votes' => [
                'title' => '기능 요청',
                'description' => '원하는 기능을 요청하는 글에 투표할 수 있습니다. (매월 2번 투표 가능)',
            ],

            'sort_options' => [
                'title' => '정렬 옵션',
                'description' => '게임 내에서 비트맵 랭킹을 국가 / 친구 / 모드별 랭킹 기준으로 볼 수 있습니다.',
            ],

            'feel_special' => [
                'title' => '특별한 기분을 느끼세요',
                'description' => 'osu!가 더 원할하게 운영되도록 그 일부가 되었다는 따스하고 포근한 기분을 느껴보세요!',
            ],

            'more_to_come' => [
                'title' => '더 많은 기능이 생길거에요',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => '납득했습니다! :D',
            'support' => 'osu! 지원하기',
            'gift' => '아니면 osu!를 지원하여 다른 플레이어에게 선물할 수도 있습니다.',
            'instructions' => '하트 버튼을 누르면 osu!상점으로 이동합니다.',
        ],
    ],
];

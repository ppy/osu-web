<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
            'big_description' => 'Харесвате osu!?<br/>
                                  Подкрепете разработката на osu! :D',
            'small_description' => '',
            'support_button' => 'Искам да подкрепя osu!',
        ],

        'dev_quote' => 'osu! е изцяло безплатна, но за съжаление поддръжката й въобще не е.
        От цената за поддръжка на сървърите до висококачествената международна честотна лента, времето прекарано в профилактика на системите и в контакт с играчите,
        осигуряването на награди за турнири, отговарянето на запитвания и цялостното задоволяване на хората, osu! засмуква доста голямо количесто пари и време.
        О, и не забравяме факта, че ние не използваме реклами в продуктите си и не партнираме с компании, които биха могли да нарушат вашето удоволствие към играта.
            <br/><br/>В края на деня до-голяма степен osu! се разработва и поддържа от мен, който вие може би познавате като "peppy".
Наложи се да напусна работата си, за да не изоставам с разработката на osu! и често ми се налага да отделя повече време на отделни части на играта, за да запазя високия й стандарт.
            Бих искал да отправя личната си благодарност към тези, които решиха да подкрепят osu! досега и само още толкова на тези, които продължават да подпомагат финансово тази изумителна игра и нейното сплотено общество :).',

        'supporter_status' => [
            'contribution' => 'Благодарим ви за вашата подкрепа досега! Вие допринесохте общо :dollars за :tags osu!supporter покупки!',
            'gifted' => ':giftedTags от osu!supporter покупките Ви са подарени (общо :giftedDollars подарени), колко щедро!',
            'not_yet' => "Вие все още нямате osu!supporter :(",
            'title' => 'Текущият ви osu!supporter статус',
            'valid_until' => 'Вашият osu!supporter е валиден до :date!',
            'was_valid_until' => 'Вашият osu!supporter беше валиден до преди :date.',
        ],

        'why_support' => [
            'title' => 'Защо да подрепя osu!?',
            'blocks' => [
                'dev' => 'Разработено от поддържано от един човек от Австралия',
                'time' => 'Отнема толкова време да се поддържа, че вече не може да го наречем "хоби".',
                'ads' => 'Без реклами<br/><br/>За разлика от 99.95% от целия Интернет, ние не печелим като наблъскваме реклами в лицето Ви.',
                'goodies' => 'Получавате някои екстри!',
            ],
        ],

        'perks' => [
            'title' => 'О? Какво получавам?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'кратък и лесен достъп до нови бийтмапове без да е нужно да излизате от играта.',
            ],

            'auto_downloads' => [
                'title' => 'Автоматично теглене',
                'description' => 'Автоматичното теглене на бийтмапове докато сте в мултиплейър, наблюдавате други или с кликане на линковете в чата!',
            ],

            'upload_more' => [
                'title' => 'Качвайте повече',
                'description' => 'Допълнителни слотове за бийтмапове чакащи класиране (на класиран бийтмап) до максимум 10.',
            ],

            'early_access' => [
                'title' => 'Ранен достъп',
                'description' => 'Достъп до ранни версии, където може да изпробвате нови функции преди да станат публични!',
            ],

            'customisation' => [
                'title' => 'Персонализация',
                'description' => 'Персонализирайте си профила като получите пълен достъп до профилната си страница.',
            ],

            'beatmap_filters' => [
                'title' => 'Бийтмап филтри',
                'description' => 'Филтрирайте бийтмап търсенията по играни и неиграни карти и постигнати ранкове (ако има някакви).',
            ],

            'yellow_fellow' => [
                'title' => 'Златен приятел',
                'description' => 'Бъдете разпознати в игра със своето жълто потребителско име в чата.',
            ],

            'speedy_downloads' => [
                'title' => 'Бързо теглене',
                'description' => 'По-леки ограничения по време на теглене, особено когато ползвате osu!direct.',
            ],

            'change_username' => [
                'title' => 'Промяна на името',
                'description' => 'Способността да си промените потребителското име без допълнително заплащане (само веднъж)',
            ],

            'skinnables' => [
                'title' => 'Скин персонализация',
                'description' => 'Допълнителни скин екстри като възможноста да си зададете заден фон в главното меню.',
            ],

            'feature_votes' => [
                'title' => 'Гласуване за нови функции',
                'description' => 'Възможността да гласувате за добавянето на нови функции в osu! (2 на месец)',
            ],

            'sort_options' => [
                'title' => 'Опции за сортиране',
                'description' => 'Способността да видите бийтмап класациите по страна / приятели / мод-специфични по време на игра.',
            ],

            'feel_special' => [
                'title' => 'Чувствайте се специални',
                'description' => 'Приятното чувство от това да помогнеш финансово за гладкото развитие на osu!',
            ],

            'more_to_come' => [
                'title' => 'И много други',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => 'Аз съм убеден! :D',
            'support' => 'подкрепете osu!',
            'gift' => 'или подарете osu!support на други играчи',
            'instructions' => 'щракнете на розовият бутон със сърце горе, за да продължите към osu!store',
        ],
    ],
];

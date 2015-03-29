<?php

return [
    'tags' => [
        // Standard inline
        [ 'class' => 'App\Helpers\BBCode\Tags\Tag',      'scopes' => [ ], 'token' => 'b',      'element' => 'strong'                                   ],
        [ 'class' => 'App\Helpers\BBCode\Tags\Tag',      'scopes' => [ ], 'token' => 'i',      'element' => 'em'                                       ],
        [ 'class' => 'App\Helpers\BBCode\Tags\Tag',      'scopes' => [ ], 'token' => 'u',      'element' => 'span', 'element_class' => 'underline'     ],
        [ 'class' => 'App\Helpers\BBCode\Tags\Tag',      'scopes' => [ ], 'token' => 's',      'element' => 'span', 'element_class' => 'strikethrough' ],

        [ 'class' => 'App\Helpers\BBCode\Tags\Tag',      'scopes' => [ ], 'token' => 'green',  'element' => 'span', 'element_class' => 'green'         ],
        [ 'class' => 'App\Helpers\BBCode\Tags\Tag',      'scopes' => [ ], 'token' => 'blue',   'element' => 'span', 'element_class' => 'blue'          ],
        [ 'class' => 'App\Helpers\BBCode\Tags\Tag',      'scopes' => [ ], 'token' => 'purple', 'element' => 'span', 'element_class' => 'purple'        ],

        // Standard block
        [ 'class' => 'App\Helpers\BBCode\Tags\PreTag',   'scopes' => [ ] ],

        // Links
        [ 'class' => 'App\Helpers\BBCode\Tags\LinkTag',      'scopes' => [ ], 'token' => 'url' ],
        [ 'class' => 'App\Helpers\BBCode\Tags\LinkTag',      'scopes' => [ ], 'token' => 'email' ],
        [ 'class' => 'App\Helpers\BBCode\Tags\QuickLinkTag', 'scopes' => [ ] ],
        [ 'class' => 'App\Helpers\BBCode\Tags\WikiLinkTag',  'scopes' => [ ] ],

        // Embedded
        [ 'class' => 'App\Helpers\BBCode\Tags\ImageTag',     'scopes' => [ ], 'token' => 'img' ],
        [ 'class' => 'App\Helpers\BBCode\Tags\ImageTag',     'scopes' => [ ], 'token' => 'simg' ],
        [ 'class' => 'App\Helpers\BBCode\Tags\WIkiImageTag', 'scopes' => [ ] ],

        [ 'class' => 'App\Helpers\BBCode\Tags\YoutubeTag',     'scopes' => [ ] ],
        [ 'class' => 'App\Helpers\BBCode\Tags\WikiYoutubeTag', 'scopes' => [ ] ],

        // Custom
        [ 'class' => 'App\Helpers\BBCode\Tags\QuoteTag',         'scopes' => [ ] ],
        [ 'class' => 'App\Helpers\BBCode\Tags\FontTag',          'scopes' => [ ] ],
        [ 'class' => 'App\Helpers\BBCode\Tags\WikiCategoryTag',  'scopes' => [ ] ],
    ],
    'elements' => [
        [ 'class' => 'App\Helpers\BBCode\Elements\MdHeadingElement', 'scopes' => [] ],
        [ 'class' => 'App\Helpers\BBCode\Elements\MdLineElement',    'scopes' => [] ],
        [ 'class' => 'App\Helpers\BBCode\Elements\MdQuoteElement',   'scopes' => [] ],
        [ 'class' => 'App\Helpers\BBCode\Elements\MdListElement',    'scopes' => [] ],
        [ 'class' => 'App\Helpers\BBCode\Elements\MdCodeElement',    'scopes' => [] ],
        [ 'class' => 'App\Helpers\BBCode\Elements\MdTableElement',   'scopes' => [] ],
    ],
    'processors' => [
        [ 'class' => 'App\Helpers\BBCode\Processors\AutoLinkingProcessor', 'scopes' => [] ],
        [
            'class' => 'App\Helpers\BBCode\Processors\SmiliesProcessor',
            'scopes' => [],
            'smilies' => [
                'aggrieved'    => [ ':aggrieved:'              ],
                'aghast'       => [ ':aghast:'                 ],
                'angry'        => [ ':x', ':-x', ':angry:'     ],
                'badass'       => [ ':badass:'                 ],
                'confused'     => [ ':confused:'               ],
                'cry'          => [ ':cry:'                    ],
                'cyclops'      => [ ':cyclops:'                ],
                'lol'          => [ ':lol:'                    ],
                'frown'        => [ ':|', ':-|', ':frown:'     ],
                'furious'      => [ ':furious:'                ],
                'glad'         => [ ':glad:'                   ],
                'heart'        => [ ':heart:'                  ],
                'grin'         => [ ':D', ':-D', ':grin:'      ],
                'nervous'      => [ ':nervous:'                ],
                'nuke'         => [ ':nuke:'                   ],
                'nuts'         => [ ':nuts:'                   ],
                'quizzical'    => [ ':quizzical:'              ],
                'rollseyes'    => [ ':roll:', ':rollseyes:'    ],
                'sad'          => [ ':(', ':-(', ':sad:'       ],
                'smile'        => [ ':)', ':-)', ':smile:'     ],
                'surprised'    => [ ':o', ':-o', ':surprised:' ],
                'thebox'       => [ ':thebox:'                 ],
                'thefinger'    => [ ':thefinger:'              ],
                'tired'        => [ ':tired:'                  ],
                'tongue'       => [ ':P', ':-P', ':tongue:'    ],
                'toocool'      => [ ':cool:'                   ],
                'unsure'       => [ ':\\', ':-\\', ':unsure:'  ],
                'biggrin'      => [ ':biggrin:'                ],
                'wink'         => [ ';)', ';-)', ':wink:'      ],
                'zonked'       => [ ':zonked:'                 ],
                'sarcastic'    => [ ':sarcastic:'              ],
                'combine'      => [ ':combine:', ':elite:'     ],
                'gak'          => [ ':gak:'                    ],
                'animehappy'   => [ ':^_^:'                    ],
                'pwnt'         => [ ':pwned:'                  ],
                'target'       => [ ':target:'                 ],
                'ninja'        => [ ':ninja:'                  ],
                'hammer'       => [ ':hammer:'                 ],
                'pirate'       => [ ':pirate:', ':yar:'        ],
                'walter'       => [ ':walter:'                 ],
                'plastered'    => [ ':plastered:'              ],
                'bigmouth'     => [ ':zomg:'                   ],
                'brokenheart'  => [ ':heartbreak:'             ],
                'ciggiesmilie' => [ ':ciggie:'                 ],
                'combines'     => [ ':combines:'               ],
                'crowbar'      => [ ':crowbar:'                ],
                'death'        => [ ':death:'                  ],
                'freeman'      => [ ':freeman:'                ],
                'hecu'         => [ ':hecu:'                   ],
                'nya'          => [ ':nya:'                    ],
            ]
        ],
        [ 'class' => 'App\Helpers\BBCode\Processors\NewLineProcessor',     'scopes' => [] ],
    ]
];

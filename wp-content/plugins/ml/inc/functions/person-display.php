<?php 

function person_data_display( $args ){
    $classes = ['psfResult__section','psfResult__section_'.$slug];
    $block = '<div class="'. implode(' ',$classes).'">';
    if( $args['title'] ){
        $blockTitle = '<h3 class="psfResult__sectionTitle">'.$args['title'].'</h3>';
        $block .= $blockTitle;
    }
    if( $args['hint'] ){
        $blockHint = '<p class="psfResult__sectionHint">'.$args['hint'].'</p>';
        $block .= $blockHint;
    }
    $elements = [];
    foreach ($args['data'] as $element) {
        switch ($args['slug']) {
            case 'phones':
                $elements[] = '<a class="psfResult__sectionItem psfResult__sectionItem_phone" href="tel:'.$element.'">'.$element.'</a>';
            break;
            case 'emails':
                $elements[] = '<a class="psfResult__sectionItem psfResult__sectionItem_email" href="mailto:'.$element.'">'.$element.'</a>';
            break;
            case 'addresses':
                $address = (array) json_decode( $element );
                $elements[] = '<p class="psfResult__sectionItem psfResult__sectionItem_address">'.$address['street'].', '.$address['city'].', '.$address['state'].' '.$address['zip'].'</p>';
            break;
            case 'additional_addresses':
                $address = (array) $element;
                $elements[] = '<p class="psfResult__sectionItem psfResult__sectionItem_address psfResult__sectionItem_additionalAddress">'.$address['street'].', '.$address['city'].', '.$address['state'].' '.$address['zip'].'</p>';
            break;
        }
    }

    $elementsContainer = '<div class="psfResult__sectionContent">'.implode('',$elements).'</div>';
    $block .= $elementsContainer;
    $block .= '</div>';

    return $block;
}

function person_display( $person){

    $personContent = '';
    
    // Name
    $personName = '
        <h3 class="psfPerson__name">'.
            $person['firstName'].' '.$person['middleName'][0].' '.$person['lastName'].
        '</h3>'
    ;
    $personContent .= $personName;

    // Age
    $age = $person['age'][0];
    $dob = $person['dob'][0];
    $personAge = '';
    if( $age || $dob ){
        $personAge .= '<p class="psfPerson__age">';
        if( $age ){
            $personAge .= $age.' years old';
        }
        if( $age && $dob ){
            $personAge .= '; ';
        }
        if( $dob ){
            $personAge .= 'Born on '.$dob;
        }
        $personAge .= '</p>';
    }
    $personContent .= $personAge;

    // Phones
    $phones = person_data_display([
        'title' => 'Phones',
        'hint' => 'Phones for this person.',
        'slug' => 'phones',
        'data' => $person['phones']
    ]);
    $personContent .= $phones;

    // Addresses
    $addresses = person_data_display([
        'title' => 'Addresses',
        'hint' => 'Addresses for this person.',
        'slug' => 'addresses',
        'data' => $person['addresses']
    ]);
    $personContent .= $addresses;

    // Emails
    $emails = person_data_display([
        'title' => 'Emails',
        'hint' => 'Emails for this person.',
        'slug' => 'emails',
        'data' => $person['emails']
    ]);
    $personContent .= $emails;


    $personElement = '<div class="mlCard psfPerson">'.$personContent.'</div>';

    return $personElement;
}

// function render_card( $args ){
//     $cardClasses = ['mlCard'];
//     if( $args['prefix'] ){
//         $cardClasses[] = 'mlCard_withPrefix';

//         $prefixClasses = ['mlCard__prefix'];
//         if( $args['prefixStyle'] ){ $prefixClasses[] = 'mlCard__prefix_'.strtolower( $args['prefixStyle']) }
//     } 
//     if( $args['prefixType'] ){ $cardClasses[] = ''; } 

//     $cardContent = '';

//     $card = '<div class="'.implode(' ',$cardClasses).'">'.$cardContent.'</div>';
//     return $card;
// }
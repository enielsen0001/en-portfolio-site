<?php

$category_names = array(
    'A' => "Languages",
    'B' => "Frameworks and Libraries",
    'C' => "Design and Collaboration",
    'D' => "Platforms and CMS",
    'E' => "Workflow and Quality",
);

$skillsArr = array(
    'A' => array(
        array('name' => 'HTML', 'level' => 10),
        array('name' => 'JavaScript', 'level' => 10),
        array('name' => 'TypeScript', 'level' => 8),
        array('name' => 'PHP', 'level' => 1),
        array('name' => 'API Integration', 'level' => 10),
        array('name' => 'C#', 'level' => 3),
        array('name' => 'Node.js', 'level' => 3),
    ),
    'B' => array(
        array('name' => 'React', 'level' => 8),
        array('name' => 'Redux', 'level' => 6),
        array('name' => 'jQuery', 'level' => 9),
        array('name' => 'CSS', 'level' => 10),
        array('name' => 'SCSS/Sass', 'level' => 10),
        array('name' => 'Bootstrap', 'level' => 6),
        array('name' => 'Next.js', 'level' => 4),
        array('name' => 'Data Visualization (D3.js)', 'level' => 3),
    ),
    'C' => array(
        array('name' => 'Figma', 'level' => 8),
        array('name' => 'Storybook', 'level' => 2),
        array('name' => 'Photoshop', 'level' => 6),
        array('name' => 'Git', 'level' => 8),
        array('name' => 'Web Design', 'level' => 6),
        array('name' => 'Responsive Design', 'level' => 10),
    ),
    'D' => array(
        array('name' => 'Custom CMS', 'level' => 10),
        array('name' => 'Contentful', 'level' => 4),
        array('name' => 'Shopify Theme Development', 'level' => 7),
        array('name' => 'Shopify App Development', 'level' => 4),
        array('name' => 'WordPress Theme Development', 'level' => 4),
        array('name' => 'Salesforce Commerce Cloud', 'level' => 2),
        array('name' => 'Webflow', 'level' => 1),
    ),
    'E' => array(
        array('name' => 'Unit Testing (Jest, Enzyme)', 'level' => 6),
        array('name' => 'Accessibility Best Practices', 'level' => 8),
        array('name' => 'Code Reviews', 'level' => 8),
        array('name' => 'Agile Development', 'level' => 6),
    ),
);

/**
 * Partial for displaying skills categorized.
 *
 * This partial expects one PHP variable to be available in the scope where it's included:
 * - $skillsArr: An associative array where keys are category keys (A, B, C, D, E)
 * and values are arrays of skill objects for that category.
 * Each skill object should have 'name' and 'level' properties.
 */

if ( ! empty( $skillsArr ) && is_array( $skillsArr ) ) :
?>
<div class="skills-wrap">

    <?php foreach ( $skillsArr as $category_key => $skills ) : ?>
        <?php
        if ( isset( $category_names[ $category_key ] ) ) :
            $category_name = $category_names[ $category_key ];
            ?>
            <h4><?php echo esc_html( $category_name ); ?></h4>
            <ul class="skills-list list-reset">
                <?php foreach ( $skills as $skill ) : ?>
                    <?php
                    $name       = isset( $skill['name'] ) ? sanitize_text_field( $skill['name'] ) : '';
                    $level      = isset( $skill['level'] ) ? intval( $skill['level'] ) : 0;
                    $percentVal = ($level / 10) * 100;
                    ?>
                    <li class="skill-bar watch-in-view">
                        <span class="skill-bar__text"><?php echo esc_html( $name ); ?></span>
                        <span class="sr-only"> proficiency <?php echo esc_html( $percentVal ); ?> percent</span>
                        <div class="skill-bar__bar width-<?php echo esc_attr( $level ); ?>"></div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    <?php endforeach; ?>

</div>
<?php
else :
    // Optional: Display a message if the data is not available
    echo '<p>Skills data is not available.</p>';
endif;
?>
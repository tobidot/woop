<?php

namespace woop;

require_once 'ThemeTemplateBuilder.php';

class ArchiveTemplateBuilder extends ThemeTemplateBuilder
{
    public function main(?IBuilder $inner = null): IBuilder
    {
        return parent::main((new BuilderCollection)
            ->add_callback(function () {
                $class_prefix = $this->theme_class_prefix->build('');
                $result = '';
                while (have_posts()) {
                    the_post();
                    $title = get_the_title();
                    $content = get_the_excerpt();
                    $result .= <<< HTML
                    <section class="$class_prefix-excerpt">
                        <h2>$title</h2>
                        <p>$content</p>
                    </section>
HTML;
                }
                return <<< HTML
                <p>
                    Archive
                </p>
                <div class="$class_prefix-archive">
                    $result
                </div>
HTML;
            })
            ->add_element($inner));
    }
}

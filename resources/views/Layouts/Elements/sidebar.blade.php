<div class="sidebar">
    <ul>
        <li>
            {{ Html::link(
                route('prompts.index'),
                __('general.header.prompts'),
                [
                    'class' => Request::is('prompts') ? 'active' : '',
                ]
            ) }}
        </li>
        <li>
            {{ Html::link(
                route('extra_info.index'),
                __('general.header.extra_info'),
                [
                    'class' => Request::is('extra_info') ? 'active' : '',
                ]
            ) }}
        </li>
        <li>
            {{ Html::link(
                route('analytics.index'),
                __('general.header.analytics'),
                [
                    'class' => Request::is('analytics') ? 'active' : '',
                ]
            ) }}
        </li>
    </ul>
</div>

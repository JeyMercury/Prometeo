<?php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('home');
});

// Home > Prompts
Breadcrumbs::for('prompts.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('prompts', route('prompts.index'));
});

Breadcrumbs::for('extra_info.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('extra_info', route('extra_info.index'));
});

Breadcrumbs::for('analytics.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('analytics', route('analytics.index'));
});

// Home > Blog > [Category]
// Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
//     $trail->parent('blog');
//     $trail->push($category->title, route('category', $category));
// });

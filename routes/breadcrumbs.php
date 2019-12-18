<?php
// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});


// Organizations
Breadcrumbs::for('organizations.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('resources.organizations'), route('organizations.index'));
});

Breadcrumbs::for('organizations.show', function ($trail, $organization) {
    $trail->parent('organizations.index');
    $trail->push($organization->name, route('organizations.show', ['organization' => $organization->id]));
});

Breadcrumbs::for('organizations.edit', function ($trail, $organization) {
    $trail->parent('organizations.show', $organization);
    $trail->push(__('interface.edit'), route('organizations.edit', ['organization' => $organization->id]));
});

Breadcrumbs::for('organizations.create', function ($trail) {
    $trail->parent('organizations.index');
    $trail->push(__('interface.add'), route('organizations.create'));
});

// Sources
Breadcrumbs::for('sources.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('resources.sources'), route('sources.index'));
});

Breadcrumbs::for('sources.show', function ($trail, $source) {
    $trail->parent('sources.index');
    $trail->push($source->name, route('sources.show', ['source' => $source->id]));
});

Breadcrumbs::for('sources.edit', function ($trail, $source) {
    $trail->parent('sources.show', $source);
    $trail->push(__('interface.edit'), route('sources.edit', ['source' => $source->id]));
});

Breadcrumbs::for('sources.create', function ($trail) {
    $trail->parent('sources.index');
    $trail->push(__('interface.add'), route('sources.create'));
});

Breadcrumbs::for('sources.access-logs', function ($trail, $source) {
    $trail->parent('sources.show', $source);
    $trail->push(__('resources.log.source-access-logs'), route('sources.access-logs', ['source' => $source->id]));
});

Breadcrumbs::for('sources.activities', function ($trail, $source) {
    $trail->parent('sources.show', $source);
    $trail->push(__('resources.log.activities'), route('sources.activities', ['source' => $source->id]));
});

// Bridges
Breadcrumbs::for('bridges.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('resources.bridges'), route('bridges.index'));
});

Breadcrumbs::for('bridges.show', function ($trail, $bridge) {
    $trail->parent('bridges.index');
    $trail->push($bridge->name, route('bridges.show', ['bridge' => $bridge->id]));
});

Breadcrumbs::for('bridges.edit', function ($trail, $bridge) {
    $trail->parent('bridges.show', $bridge);
    $trail->push(__('interface.edit'), route('bridges.edit', ['bridge' => $bridge->id]));
});

Breadcrumbs::for('bridges.create', function ($trail) {
    $trail->parent('bridges.index');
    $trail->push(__('interface.add'), route('bridges.create'));
});

Breadcrumbs::for('bridges.activities', function ($trail, $bridge) {
    $trail->parent('bridges.show', $bridge);
    $trail->push(__('resources.log.activities'), route('bridges.activities', ['bridge' => $bridge->id]));
});

// Activities
Breadcrumbs::for('activities.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('resources.log.activities'), route('activities.index'));
});

Breadcrumbs::for('activities.show', function ($trail, $activity) {
    $trail->parent('activities.index');
    $trail->push($activity->id, route('activities.show', ['activity' => $activity->id]));
});

// Source Access Log
Breadcrumbs::for('source-access-logs.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('resources.log.source-access-logs'), route('source-access-logs.index'));
});

Breadcrumbs::for('source-access-logs.show', function ($trail, $sourceAccessLog) {
    $trail->parent('source-access-logs.index');
    $trail->push($sourceAccessLog->id, route('source-access-logs.show', ['sourceAccessLog' => $sourceAccessLog->id]));
});

<?php

test('checks if routes are exist in tag file that is located in admin v1 folder', function () {
    $tagURL = config('app.url') . '/' . config('route-prefix.admin.v1.prefix') . '/' . config('route-prefix.admin.v1.tag');

    $this->expect(route('admin.tag.index'))
        ->toBe($tagURL . '/tag');

    $this->expect(route('admin.tag.show', ['tag' => '0']))
        ->toBe($tagURL . '/tag/0');

    $this->expect(route('admin.tag.store'))
        ->toBe($tagURL . '/tag');

    $this->expect(route('admin.tag.update', ['tag' => '0']))
        ->toBe($tagURL . '/tag/0');

    $this->expect(route('admin.tag.destroy', ['tag' => '0']))
        ->toBe($tagURL . '/tag/0');
});

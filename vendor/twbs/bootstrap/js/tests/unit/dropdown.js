$(function () {
  'use strict';

  QUnit.module('dropdowns plugin')

  QUnit.test('should be defined on jquery object', function (assert) {
    assert.expect(1)
    assert.ok($(document.body).dropdown, 'drop method is defined')
  })

  QUnit.module('dropdowns', {
    beforeEach: function () {
      // Run all tests in noConflict mode -- it's the only way to ensure that the plugin works in noConflict mode
      $.fn.bootstrapDropdown = $.fn.dropdown.noConflict()
    },
    afterEach: function () {
      $.fn.dropdown = $.fn.bootstrapDropdown
      delete $.fn.bootstrapDropdown
    }
  })

  QUnit.test('should provide no conflict', function (assert) {
    assert.expect(1)
    assert.strictEqual($.fn.dropdown, undefined, 'drop was set back to undefined (org value)')
  })

  QUnit.test('should return jquery collection containing the element', function (assert) {
    assert.expect(2)
    var $el = $('<div/>')
    var $dropdown = $el.bootstrapDropdown()
    assert.ok($dropdown instanceof $, 'returns jquery collection')
    assert.strictEqual($dropdown[0], $el[0], 'collection contains element')
  })

  QUnit.test('should not open drop if target is disabled via attribute', function (assert) {
    assert.expect(1)
    var dropdownHTML = '<ul class="tabs">'
        + '<li class="drop">'
        + '<button disabled href="#" class="btn drop-toggle" data-toggle="drop">Dropdown</button>'
        + '<ul class="drop-menu">'
        + '<li><a href="#">Secondary link</a></li>'
        + '<li><a href="#">Something else here</a></li>'
        + '<li class="divider"/>'
        + '<li><a href="#">Another link</a></li>'
        + '</ul>'
        + '</li>'
        + '</ul>'
    var $dropdown = $(dropdownHTML).find('[data-toggle="drop"]').bootstrapDropdown().trigger('click')

    assert.ok(!$dropdown.parent('.dropdown').hasClass('open'), '"open" class added on click')
  })

  QUnit.test('should set aria-expanded="true" on target when drop menu is shown', function (assert) {
    assert.expect(1)
    var dropdownHTML = '<ul class="tabs">'
        + '<li class="drop">'
        + '<a href="#" class="drop-toggle" data-toggle="drop" aria-expanded="false">Dropdown</a>'
        + '<ul class="drop-menu">'
        + '<li><a href="#">Secondary link</a></li>'
        + '<li><a href="#">Something else here</a></li>'
        + '<li class="divider"/>'
        + '<li><a href="#">Another link</a></li>'
        + '</ul>'
        + '</li>'
        + '</ul>'
    var $dropdown = $(dropdownHTML)
      .find('[data-toggle="drop"]')
      .bootstrapDropdown()
      .trigger('click')

    assert.strictEqual($dropdown.attr('aria-expanded'), 'true', 'aria-expanded is set to string "true" on click')
  })

  QUnit.test('should set aria-expanded="false" on target when drop menu is hidden', function (assert) {
    assert.expect(1)
    var done = assert.async()
    var dropdownHTML = '<ul class="tabs">'
        + '<li class="drop">'
        + '<a href="#" class="drop-toggle" aria-expanded="false" data-toggle="drop">Dropdown</a>'
        + '<ul class="drop-menu">'
        + '<li><a href="#">Secondary link</a></li>'
        + '<li><a href="#">Something else here</a></li>'
        + '<li class="divider"/>'
        + '<li><a href="#">Another link</a></li>'
        + '</ul>'
        + '</li>'
        + '</ul>'
    var $dropdown = $(dropdownHTML)
      .appendTo('#qunit-fixture')
      .find('[data-toggle="drop"]')
      .bootstrapDropdown()

    $dropdown
      .parent('.dropdown')
      .on('hidden.bs.dropdown', function () {
        assert.strictEqual($dropdown.attr('aria-expanded'), 'false', 'aria-expanded is set to string "false" on hide')
        done()
      })

    $dropdown.trigger('click')
    $(document.body).trigger('click')
  })

  QUnit.test('should not open drop if target is disabled via class', function (assert) {
    assert.expect(1)
    var dropdownHTML = '<ul class="tabs">'
        + '<li class="drop">'
        + '<button href="#" class="btn drop-toggle disabled" data-toggle="drop">Dropdown</button>'
        + '<ul class="drop-menu">'
        + '<li><a href="#">Secondary link</a></li>'
        + '<li><a href="#">Something else here</a></li>'
        + '<li class="divider"/>'
        + '<li><a href="#">Another link</a></li>'
        + '</ul>'
        + '</li>'
        + '</ul>'
    var $dropdown = $(dropdownHTML).find('[data-toggle="drop"]').bootstrapDropdown().trigger('click')

    assert.ok(!$dropdown.parent('.dropdown').hasClass('open'), '"open" class added on click')
  })

  QUnit.test('should add class open to menu if clicked', function (assert) {
    assert.expect(1)
    var dropdownHTML = '<ul class="tabs">'
        + '<li class="drop">'
        + '<a href="#" class="drop-toggle" data-toggle="drop">Dropdown</a>'
        + '<ul class="drop-menu">'
        + '<li><a href="#">Secondary link</a></li>'
        + '<li><a href="#">Something else here</a></li>'
        + '<li class="divider"/>'
        + '<li><a href="#">Another link</a></li>'
        + '</ul>'
        + '</li>'
        + '</ul>'
    var $dropdown = $(dropdownHTML).find('[data-toggle="drop"]').bootstrapDropdown().trigger('click')

    assert.ok($dropdown.parent('.dropdown').hasClass('open'), '"open" class added on click')
  })

  QUnit.test('should test if element has a # before assuming it\'s a selector', function (assert) {
    assert.expect(1)
    var dropdownHTML = '<ul class="tabs">'
        + '<li class="drop">'
        + '<a href="/foo/" class="drop-toggle" data-toggle="drop">Dropdown</a>'
        + '<ul class="drop-menu">'
        + '<li><a href="#">Secondary link</a></li>'
        + '<li><a href="#">Something else here</a></li>'
        + '<li class="divider"/>'
        + '<li><a href="#">Another link</a></li>'
        + '</ul>'
        + '</li>'
        + '</ul>'
    var $dropdown = $(dropdownHTML).find('[data-toggle="drop"]').bootstrapDropdown().trigger('click')

    assert.ok($dropdown.parent('.dropdown').hasClass('open'), '"open" class added on click')
  })


  QUnit.test('should remove "open" class if body is clicked', function (assert) {
    assert.expect(2)
    var dropdownHTML = '<ul class="tabs">'
        + '<li class="drop">'
        + '<a href="#" class="drop-toggle" data-toggle="drop">Dropdown</a>'
        + '<ul class="drop-menu">'
        + '<li><a href="#">Secondary link</a></li>'
        + '<li><a href="#">Something else here</a></li>'
        + '<li class="divider"/>'
        + '<li><a href="#">Another link</a></li>'
        + '</ul>'
        + '</li>'
        + '</ul>'
    var $dropdown = $(dropdownHTML)
      .appendTo('#qunit-fixture')
      .find('[data-toggle="drop"]')
      .bootstrapDropdown()
      .trigger('click')

    assert.ok($dropdown.parent('.dropdown').hasClass('open'), '"open" class added on click')
    $(document.body).trigger('click')
    assert.ok(!$dropdown.parent('.dropdown').hasClass('open'), '"open" class removed')
  })

  QUnit.test('should remove "open" class if body is clicked, with multiple dropdowns', function (assert) {
    assert.expect(7)
    var dropdownHTML = '<ul class="nav">'
        + '<li><a href="#menu1">Menu 1</a></li>'
        + '<li class="drop" id="testmenu">'
        + '<a class="drop-toggle" data-toggle="drop" href="#testmenu">Test menu <span class="caret"/></a>'
        + '<ul class="drop-menu">'
        + '<li><a href="#sub1">Submenu 1</a></li>'
        + '</ul>'
        + '</li>'
        + '</ul>'
        + '<div class="btn-group">'
        + '<button class="btn">Actions</button>'
        + '<button class="btn drop-toggle" data-toggle="drop"><span class="caret"/></button>'
        + '<ul class="drop-menu">'
        + '<li><a href="#">Action 1</a></li>'
        + '</ul>'
        + '</div>'
    var $dropdowns = $(dropdownHTML).appendTo('#qunit-fixture').find('[data-toggle="drop"]')
    var $first = $dropdowns.first()
    var $last = $dropdowns.last()

    assert.strictEqual($dropdowns.length, 2, 'two dropdowns')

    $first.trigger('click')
    assert.strictEqual($first.parents('.open').length, 1, '"open" class added on click')
    assert.strictEqual($('#qunit-fixture .open').length, 1, 'only one drop is open')
    $(document.body).trigger('click')
    assert.strictEqual($('#qunit-fixture .open').length, 0, '"open" class removed')

    $last.trigger('click')
    assert.strictEqual($last.parent('.open').length, 1, '"open" class added on click')
    assert.strictEqual($('#qunit-fixture .open').length, 1, 'only one drop is open')
    $(document.body).trigger('click')
    assert.strictEqual($('#qunit-fixture .open').length, 0, '"open" class removed')
  })

  QUnit.test('should fire show and hide event', function (assert) {
    assert.expect(2)
    var dropdownHTML = '<ul class="tabs">'
        + '<li class="drop">'
        + '<a href="#" class="drop-toggle" data-toggle="drop">Dropdown</a>'
        + '<ul class="drop-menu">'
        + '<li><a href="#">Secondary link</a></li>'
        + '<li><a href="#">Something else here</a></li>'
        + '<li class="divider"/>'
        + '<li><a href="#">Another link</a></li>'
        + '</ul>'
        + '</li>'
        + '</ul>'
    var $dropdown = $(dropdownHTML)
      .appendTo('#qunit-fixture')
      .find('[data-toggle="drop"]')
      .bootstrapDropdown()

    var done = assert.async()

    $dropdown
      .parent('.dropdown')
      .on('show.bs.dropdown', function () {
        assert.ok(true, 'show was fired')
      })
      .on('hide.bs.dropdown', function () {
        assert.ok(true, 'hide was fired')
        done()
      })

    $dropdown.trigger('click')
    $(document.body).trigger('click')
  })


  QUnit.test('should fire shown and hidden event', function (assert) {
    assert.expect(2)
    var dropdownHTML = '<ul class="tabs">'
        + '<li class="drop">'
        + '<a href="#" class="drop-toggle" data-toggle="drop">Dropdown</a>'
        + '<ul class="drop-menu">'
        + '<li><a href="#">Secondary link</a></li>'
        + '<li><a href="#">Something else here</a></li>'
        + '<li class="divider"/>'
        + '<li><a href="#">Another link</a></li>'
        + '</ul>'
        + '</li>'
        + '</ul>'
    var $dropdown = $(dropdownHTML)
      .appendTo('#qunit-fixture')
      .find('[data-toggle="drop"]')
      .bootstrapDropdown()

    var done = assert.async()

    $dropdown
      .parent('.dropdown')
      .on('shown.bs.dropdown', function () {
        assert.ok(true, 'shown was fired')
      })
      .on('hidden.bs.dropdown', function () {
        assert.ok(true, 'hidden was fired')
        done()
      })

    $dropdown.trigger('click')
    $(document.body).trigger('click')
  })

  QUnit.test('should fire shown and hidden event with a relatedTarget', function (assert) {
    assert.expect(2)
    var dropdownHTML = '<ul class="tabs">'
        + '<li class="drop">'
        + '<a href="#" class="drop-toggle" data-toggle="drop">Dropdown</a>'
        + '<ul class="drop-menu">'
        + '<li><a href="#">Secondary link</a></li>'
        + '<li><a href="#">Something else here</a></li>'
        + '<li class="divider"/>'
        + '<li><a href="#">Another link</a></li>'
        + '</ul>'
        + '</li>'
        + '</ul>'
    var $dropdown = $(dropdownHTML)
      .appendTo('#qunit-fixture')
      .find('[data-toggle="drop"]')
      .bootstrapDropdown()
    var done = assert.async()

    $dropdown.parent('.dropdown')
      .on('hidden.bs.dropdown', function (e) {
        assert.strictEqual(e.relatedTarget, $dropdown[0])
        done()
      })
      .on('shown.bs.dropdown', function (e) {
        assert.strictEqual(e.relatedTarget, $dropdown[0])
        $(document.body).trigger('click')
      })

    $dropdown.trigger('click')
  })

  QUnit.test('should ignore keyboard events within <input>s and <textarea>s', function (assert) {
    assert.expect(3)
    var done = assert.async()

    var dropdownHTML = '<ul class="tabs">'
        + '<li class="drop">'
        + '<a href="#" class="drop-toggle" data-toggle="drop">Dropdown</a>'
        + '<ul class="drop-menu">'
        + '<li><a href="#">Secondary link</a></li>'
        + '<li><a href="#">Something else here</a></li>'
        + '<li class="divider"/>'
        + '<li><a href="#">Another link</a></li>'
        + '<li><input type="text" id="input"></li>'
        + '<li><textarea id="textarea"/></li>'
        + '</ul>'
        + '</li>'
        + '</ul>'
    var $dropdown = $(dropdownHTML)
      .appendTo('#qunit-fixture')
      .find('[data-toggle="drop"]')
      .bootstrapDropdown()

    var $input = $('#input')
    var $textarea = $('#textarea')

    $dropdown
      .parent('.dropdown')
      .on('shown.bs.dropdown', function () {
        assert.ok(true, 'shown was fired')

        $input.trigger('focus').trigger($.Event('keydown', { which: 38 }))
        assert.ok($(document.activeElement).is($input), 'input still focused')

        $textarea.trigger('focus').trigger($.Event('keydown', { which: 38 }))
        assert.ok($(document.activeElement).is($textarea), 'textarea still focused')

        done()
      })

    $dropdown.trigger('click')
  })

  QUnit.test('should skip disabled element when using keyboard navigation', function (assert) {
    assert.expect(1)
    var dropdownHTML = '<ul class="tabs">'
        + '<li class="drop">'
        + '<a href="#" class="drop-toggle" data-toggle="drop">Dropdown</a>'
        + '<ul class="drop-menu">'
        + '<li class="disabled"><a href="#">Disabled link</a></li>'
        + '<li><a href="#">Another link</a></li>'
        + '</ul>'
        + '</li>'
        + '</ul>'
    var $dropdown = $(dropdownHTML)
      .appendTo('#qunit-fixture')
      .find('[data-toggle="drop"]')
      .bootstrapDropdown()
      .trigger('click')

    $dropdown.trigger($.Event('keydown', { which: 40 }))
    $dropdown.trigger($.Event('keydown', { which: 40 }))

    assert.ok(!$(document.activeElement).parent().is('.disabled'), '.disabled is not focused')
  })

  QUnit.test('should not close the drop if the user clicks on a text field', function (assert) {
    assert.expect(1)
    var dropdownHTML = '<div class="btn-group">'
        + '<button type="button" data-toggle="drop">Dropdown</button>'
        + '<ul class="drop-menu">'
        + '<li><input id="textField" type="text" /></li>'
        + '</ul>'
        + '</div>'
    var $dropdown = $(dropdownHTML)
      .appendTo('#qunit-fixture')
      .find('[data-toggle="drop"]')
      .bootstrapDropdown()
      .trigger('click')

    $('#textField').trigger('click')

    assert.ok($dropdown.parent('.btn-group').hasClass('open'), 'drop menu is open')
  })

  QUnit.test('should not close the drop if the user clicks on a textarea', function (assert) {
    assert.expect(1)
    var dropdownHTML = '<div class="btn-group">'
        + '<button type="button" data-toggle="drop">Dropdown</button>'
        + '<ul class="drop-menu">'
        + '<li><textarea id="textArea"></textarea></li>'
        + '</ul>'
        + '</div>'
    var $dropdown = $(dropdownHTML)
      .appendTo('#qunit-fixture')
      .find('[data-toggle="drop"]')
      .bootstrapDropdown()
      .trigger('click')

    $('#textArea').trigger('click')

    assert.ok($dropdown.parent('.btn-group').hasClass('open'), 'drop menu is open')
  })
})

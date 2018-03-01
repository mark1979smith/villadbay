QUnit.test("Basic Manipulation of DOM", function (assert) {


    var h = $('<body>');
    $(h).append('<div class="ele1">');
    appendHtml(h, '<div class="ele2">');
    assert.ok($(h).html() == '<div class="ele1"></div><div class="ele2"></div>', 'Passed!');
});

QUnit.test("Hide specific element", function (assert) {
    var h = $('<body><div><select><option>1</option></select></div></body>');

    hideElement(h, 'select');
    assert.ok($(h).find('select').hasClass('d-none'), 'Passed!');
});

QUnit.test('Append HTML to specific Element', function (assert) {
    var h = $('<body>');
    $(h).append('<div class="ele1">');
    $('<div class="ele2">').appendTo($(h).find('.ele1'));
    appendHtmlTo(h, '<h1>test</h1>', '.ele1');
    assert.ok($(h).html() === '<div class="ele1"><div class="ele2"></div><h1>test</h1></div>' , 'Passed!');
});


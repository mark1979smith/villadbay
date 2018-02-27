function appendHtml(ele, what)
{
    if (typeof what !== 'string') {
        what=what.html();
    }

    if (typeof ele === 'string') {
        ele=$(ele);
    }

    ele.append(what).html();
}

function appendHtmlTo(ele, what, selector)
{
    if ($.trim($(ele).html()) === '') {
        console.log('HTML is empty when using appendHtmlTo()');
    }
    if ($.trim($(ele).find(selector).html()) === '') {
        console.log('Selector cannot be found in HTML when using appendHtmlTo()');
        console.log('** E: ', ele.html());
        console.log('** W: ', what);
        console.log('** S: ', selector);
    }
    if (typeof what !== 'string') {
        what=what.html();

    }
    if (typeof ele === 'string') {
        ele=$(ele);
    }
    $(what).appendTo(ele.find(selector));
}

function prependHtml(ele, what) {
    if (typeof what !== 'string') {
        what=what.html();
    }

    if (typeof ele === 'string') {
        ele=$(ele);
    }

    ele.prepend(what).html();
}

function hideElement(html, ele) {
    if (ele !== 'false') {
        html.find(ele).addClass('d-none');
    }
}

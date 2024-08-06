function send_form(page) {
    $('#post').html(`
        <form id="form" method="post">
            <input type="hidden" name="page" ="page" value="${page}">
        </form>
    `);
    $('#form').submit();
}
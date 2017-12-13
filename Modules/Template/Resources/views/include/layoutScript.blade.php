<script>
    $(function () {
        // tr 點擊會反選該row的checkbox
        $('table.trToggleCheckbox tbody tr').click(function(event) {
            if (event.target.type !== 'checkbox') {
                var selector = $(':checkbox', this);
                if (selector.length == 1) {
                    selector.trigger('click');
                }
            }
        });

        // 展開當前頁面所屬選單
        var currentPageName = $('h1#pageTitle').attr('name');
        $('ul#menu li.treeview').each(function () {
            var parent = $(this);
            $('ul li', this).each(function () {
                if ($(this).attr('name') == currentPageName) {
                    parent.addClass('active');
                }
            });
        });



        window.setTimeout(function(){ getArticleAuditCount(); }, 1000);
        setInterval(function(){ getArticleAuditCount(); }, 10 * 1000);
        // 獲得審核數
        function getArticleAuditCount () {
            $.get(
                apiDomain + '/article/audit/count',
                function (res) {
                    var count = res.article_audit_count;
                    $('span#articleAuditCount').html(count);
                }
            );
        }
    });
</script>
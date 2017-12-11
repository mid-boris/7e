<script>
    function isJson(item) {
        var json = null;
        try {
            json = JSON.parse(str);
        } catch (e) {
            return false;
        }
        return json;
    }
</script>
<script type="text/javascript" src="{{ asset('js/tokki/web/script.js') }}"></script>
<script type="text/javascript">
    const app = angular.module('appModule', []);
    app.config(['$httpProvider', function($httpProvider) {
        $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
    }]);
</script>
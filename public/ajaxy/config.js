
function config($httpProvider)
{

  //$sceProvider.enabled(false);

  $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';

}

angular
    .module('trello')
    .config(config);

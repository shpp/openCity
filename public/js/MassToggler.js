console.info('MassToggler loaded');
function MassToggler (togglerSelector, slavesSelector) {

  var $mtgl = $(togglerSelector);
  var $slaves = $(slavesSelector);
  var syncState = false;
  var silentChange = false;

  $mtgl.change(function () {
    console.info('yoo');
    if (silentChange)
      return;
    var forsedState = this.checked;
    silentChange = true;
    $slaves.each(function () {
      var slaveState = this.checked;
      if (forsedState == slaveState)
        return;
      $(this).trigger('click');
    });
    silentChange = false;
    syncState = true;
  });

  $slaves.change(function () {
    if (silentChange)
      return;
    if (!syncState)
      return;
    silentChange = true;
    if ($mtgl[0].checked)
      $mtgl.trigger('click');
    silentChange = false;
    syncState = false;
  });

};


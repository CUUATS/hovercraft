/* Remove unused ARIA roles that confuse the validator. */
$('table[role=grid]').removeAttr('role').find('th.sorting')
  .attr('role', 'button').end().on('page.dt', function() {
    $(this).find('tr[role=row]').removeAttr('role')
  }).trigger('page.dt');

$('table.dataTable').each(function() {
  /* Make the column visibility button keyboard accessible. */
  var dt = $(this).DataTable(),
    colvizButtons = dt.buttons('.buttons-colvis'),
    colvizAction = colvizButtons.action()[0];
  colvizButtons.action(function ( e, dt, button, conf ) {
    colvizAction( e, dt, button, conf );
    $('.buttons-columnVisibility').keyup(function (e) {
      if (e.keyCode == 27) {
        $('.dt-button-background').click();
        colvizButtons.nodes().first().focus();
      }
    }).first().focus();
  });
});

@extends('layout.master')
@push('module-css') 
<link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
    .form-inline .form-control.date-search{
        max-width: 50px!important;
    }

    button.dt-button, div.dt-button, a.dt-button {
      color: #fff!important;
      background-color: #007bff!important;
      border-color: #007bff!important;
      background-image: none!important;
    }

    button.dt-button:hover, div.dt-button:hover, a.dt-button:hover{
      background-color: rgba(8, 8, 158, 0.733)!important;
    }

    a.dt-button.delete-button {
      background-color: rgb(197, 11, 11)!important;
      border-color: rgb(197, 11, 11)!important;
    }

    a.dt-button.activate-button {
      background-color: rgb(7, 112, 21)!important;
      border-color: rgb(7, 112, 21)!important;
    }

    a.dt-button.deactivate-button {
      background-color: rgb(88, 90, 88)!important;
      border-color: rgb(88, 90, 88)!important;
    }

    a.dt-button.restore-button {
      background-color: rgb(27, 13, 224)!important;
      border-color: rgb(27, 13, 224)!important;
    }

    a.dt-button.delete-button:hover {
      background-color: rgba(185, 8, 8, 0.733)!important;
    }

    .card.product .card-header {
	    padding: 0px 25px 0px 27px;
	    min-height: 50px!important;
    }

    /* select[name='productsdatatable-table_length']{
      font-size: 12px!important;
      height: 28px!important;
      padding: 5px 10px!important;
    } */

    div.dataTables_length label select.form-control.form-control-sm{
      font-size: 12px!important;
      height: 28px!important;
      padding: 5px 10px!important;
    }

    select.form-control.form-control-sm.mb-2.mr-sm-2 {
      padding: 4px 8px;
      height: 31px!important;

    }

    @media screen and ( max-width: 400px ){

      li.page-item {

          display: none;
      }

      .page-item:first-child,
      .page-item:nth-child( 1 ),
      .page-item:nth-last-child( 1 ),
      .page-item:last-child,
      .page-item.active,
      .page-item.disabled {
          display: block;
      }
    }
</style> 
@stack('additional-css')   
@endpush


@section('section-body')
@yield('table')
@endsection

@push('module-script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://demo.getstisla.com/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="https://demo.getstisla.com/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
@endpush


@push('page-script-after')
<script>
  async function fetchGet(url) {
    let options = {
        headers: {
            "Content-type": "application/json",
            "X-Request-With": "XMLHttpRequest",
            "Accept": "application/json"
        }
    }
    const response = await fetch(url, options)
    if (!response.ok) {
        const message = `An error has occured: ${response.status} (${response.statusText})`;
        throw new Error(message);
    }
    const data = await response.json();
    return data
  }

  function toastWarning(message, timeout= 3000) {
      iziToast.warning({
          message: message,
          position: 'topRight',
          timeout: timeout,
      })
  }

  function toastError(message, timeout= 3000) {
      iziToast.error({
          message: message,
          position: 'topRight',
          timeout: 3000,
      })
  }

  function toastSuccess(message, timeout= 3000) {
      iziToast.success({
          message: message,
          position: 'topRight',
          timeout: 3000,
      })
  }

  function toastInfo(message, timeout= 3000) {
      iziToast.info({
          message: message,
          position: 'topRight',
          timeout: 3000,
      })
  }

  function getSelectedID(){
    checked = $('[data-checkboxes="mygroup"]:not([data-checkbox-role="dad"]):checked')
    if(checked.length < 1) {
      return {data: null}
    }
    let idArray = []
    checked.each(i => {
      let element = checked[i]
      idArray.push($(element).attr('data-id'))
    })
    return {data: idArray}
  }

  function myCheckFunction(e){
    var me = $(e),
      group = me.data('checkboxes'),
      role = me.data('checkbox-role');
    var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
        checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
        dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
        total = all.length,
        checked_length = checked.length;
  
      if(role == 'dad') {
        if(me.is(':checked')) {
          all.prop('checked', true);
        }else{
          all.prop('checked', false);
        }
      }else{
        if(checked_length >= total) {
          dad.prop('checked', true);
        }else{
          dad.prop('checked', false);
        }
      }
  }

  $('#btn-show-filter').on('click', function(){
    if($(this).attr('data-status') == 'hide'){
      $(this).attr('data-status', 'show')
      $(this).html('Sembunyikan Filter')
    } else {
      $(this).attr('data-status', 'hide')
      $(this).html('Tampilkan Filter')
    }
  })

  function myDeleteFunction()
  {
    let selectedID = getSelectedID();
    if(selectedID.data == null){
      return toastWarning('silahkan pilih data terlebih dahulu')
    }
    iziToast.question({
        overlay: true,
        toastOnce: true,
        id: 'question',
        message: 'Yakin ingin menghapus?',
        position: 'topRight',
        buttons: [
            ['<button><b>YA</b></button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast);
                deleteData(selectedID.data)

            }, true],
            ['<button>TIDAK</button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast);

            }]
        ]
    });
  }

  function myTableCustomAction(callback, confirmation_message = 'Apakah anda yakin?')
  {
    let selectedID = getSelectedID();
    if(selectedID.data == null){
      return toastWarning('silahkan pilih data terlebih dahulu')
    }
    iziToast.question({
        overlay: true,
        toastOnce: true,
        id: 'question',
        message: confirmation_message,
        position: 'topRight',
        buttons: [
            ['<button><b>YA</b></button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast);
                callback(selectedID.data)

            }, true],
            ['<button>TIDAK</button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast);

            }]
        ]
    });
  }

  function myTrashTableFunction(callback, message)
  {
    let selectedID = getSelectedID();
    if(selectedID.data == null){
      return toastWarning('silahkan pilih data terlebih dahulu')
    }
    iziToast.question({
        overlay: true,
        toastOnce: true,
        id: 'question',
        message: message,
        position: 'topRight',
        buttons: [
            ['<button><b>YA</b></button>', function (instance, toast) {
                instance.hide({ transitionOut: 'fadeOut' }, toast);
                callback(selectedID.data)

            }, true],
            ['<button>TIDAK</button>', function (instance, toast) {
                instance.hide({ transitionOut: 'fadeOut' }, toast);
            }]
        ]
    });
  }
</script>
@endpush
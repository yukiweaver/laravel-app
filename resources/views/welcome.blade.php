@extends('layouts.app')

@section('content')
<div class="container">
 <div class="row justify-content-center">
   <div class="col-md-8">
     <div class="card">
       <div class="card-header">{{ __('デモ用') }}</div>
       <div class="card-body">
         @if (count($errors) > 0)
         <div class="errors">
           <ul>
             @foreach ($errors->all() as $error)
               <li>{{$error}}</li>
             @endforeach
           </ul>
         </div>
         @endif
         <div class="caption">帳簿フォーマット登録　-　入力画面</div>
         {{-- <ul>
            <li>ラジオボタンを選択することでINSERT,UPDATE,DELETEの必須項目を一括で追加できます。
         </ul> --}}
          <form name="report_form" id="report_form" action="$base_url$/report/outputFormatReportRegConfirm" method="POST">
            <div class="form-box">
              <table class="data-list table">
                <tr>
                  <th class="t-top">帳票フォーマット名</th>
                  <td class="t-top"><input class="form-control" type="text" name="report_format_name" value=""></td>
                </tr>
              </table>
              <table class="data-list table">
                <tr>
                  <th class="t-top">共通</th>
                  <th>INSERT</th>
                  <th>UPDATE</th>
                  <th>DELETE</th>
                </tr>
                <tr>
                  <td class="t-top"></td>
                  <td class="t-top">
                    <input id="insert" type="hidden" name="insert" value="">
                    <input class="form-control" id="check_insert" type="checkbox" name="check" value="1">
                  </td>
                  <td class="t-top">
                    <input id="update" type="hidden" name="update" value="">
                    <input class="form-control" id="check_update" type="checkbox" name="check" value="2">
                  </td>
                  <td class="t-top">
                    <input id="delete" type="hidden" name="delete" value="">
                    <input class="form-control" id="check_delete" type="checkbox" name="check" value="3">
                  </td>
                </tr>
              </table>
              <table class="data-list table">
                <tr>よく使う項目</tr>
                <tr>
                  <th class="t-top">モールA</td>
                  <th>AA</td>
                  <th>BB</td>
                  <th>CC</td>
                </tr>
                <tr>
                  <td class="t-top"></td>
                  <td class="t-top">
                    <input id="insert" type="hidden" name="insert" value="">
                    <input class="form-control" id="aa" type="checkbox" name="check" value="4">
                  </td>
                  <td class="t-top">
                    <input id="update" type="hidden" name="update" value="">
                    <input class="form-control" id="bb" type="checkbox" name="check" value="5">
                  </td>
                  <td class="t-top">
                    <input id="delete" type="hidden" name="delete" value="">
                    <input class="form-control" id="cc" type="checkbox" name="check" value="6">
                  </td>
                </tr>
                <tr>
                  <th class="t-top">モールB</td>
                  <th>DD</td>
                  <th>EE</td>
                  <th>FF</td>
                </tr>
                <tr>
                  <td class="t-top"></td>
                  <td class="t-top">
                    <input id="insert" type="hidden" name="insert" value="">
                    <input class="form-control" id="dd" type="checkbox" name="check" value="7">
                  </td>
                  <td class="t-top">
                    <input id="update" type="hidden" name="update" value="">
                    <input class="form-control" id="ee" type="checkbox" name="check" value="8">
                  </td>
                  <td class="t-top">
                    <input id="delete" type="hidden" name="delete" value="">
                    <input class="form-control" id="ff" type="checkbox" name="check" value="9">
                  </td>
                </tr>
              </table>
              <div class="text-center">
                <button class="btn btn-primary" id="add_btn">追加する</button>
              </div>
              <br>
              <table class="data-list table">
                <thead>
                  <tr>
                    <th class="t-top">NO</th>
                    <th class="t-top">操作</th>
                    <th class="t-top">選択</th>
                    <th class="t-top">項目</th>
                  </tr>
                </thead>
                <tbody id="cols-tbody">
                  @include('_demo')
                </tbody>
              </table>
              <table id="temp-report-method">
                <tbody>
                  <tr>
                    <td>
                    </td>
                  </tr>
                </tbody>
              </table>
              <table id="temp-arr-count-report-method">
                <tbody>
                  <tr>
                    <td>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="button">
                <input name="_submit" class="btn btn-primary" type="submit" value="　確　認　" onClick="alert('デモ用です。登録はできません。');return false;">
              </div>
            </div>
          <input type="hidden" name="col_arr_count" value="1:">
          <input type="hidden" name="cols_check" value="">
        </form>
       </div>
     </div>
   </div>
 </div>
</div>
<script>
  function renumber() {
    var i = 1;
    $(".no").each(function() {
      $(this).html(i++);
    });
  }
  $(document).ready(function() {
    renumber();
  });

  // 行を追加する
  $(document).on("click", ".addList", function() {
    $("#cols-tbody>tr").eq(0).clone(true).insertAfter(
      $(this).parent().parent()
    );
    renumber();
  });

  // 行を削除する
  $(document).on("click", ".removeList", function() {
    $(this).parent().parent().empty();
    renumber();
  });

  // 行を一つ上に移動させる
  $(document).on("click", "#cols-tbody>tr:gt(1) .upList", function() {
    var t = $(this).parent().parent();
    if($(t).prev("tr")) {
      $(t).insertBefore($(t).prev("tr")[0]);
    }
    renumber();
  });

  // 行を一つ下に移動させる
  $(document).on("click", ".downList", function() {
    var t = $(this).parent().parent();
    if($(t).next("tr")) {
      $(t).insertAfter($(t).next("tr")[0]);
    }
    renumber();
  });

  // 行の一部を変更する
  $(document).on("change", ".changeList", function() {
    $(this).parent().next().children(":text").val($(this).val());
  });

  $(function() {
    $('#add_btn').click(function(event) {
      event.preventDefault();
      var checkList = $('input[name=check]:checked').map(function() {
        return $(this).val();
      }).get();

      $.ajax({
        url: "{{route('user.demo')}}",
        type: 'POST',
        dataType: 'html',
        data: {
          check_list: checkList,
          _token: "{{ csrf_token() }}"
        }
      })
      .done(function(data) {
        $('#cols-tbody').html(data);
        renumber();
        console.log('success');
      })
      .fail(function(data) {
        alert('failed');
      })
    })
  })
</script>
@endsection
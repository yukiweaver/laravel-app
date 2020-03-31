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

          <ul>
          <li>「↑」「↓」「+」「-」にて行の追加、削除、上下移動ができます。
          <li>「項目」にカラム名、固定値を指定してください。
          <li>カラム名は「選択」より「項目」にコピーできます。
          <li>固定文字列を出力する場合には「'」で囲んでください。例：'abc'
          <li>「項目」が空の行は項目として出力されません、空を出力する場合には''を指定してください。
          <li>「+」「-」「*」「/」「(」「)」にて算術演算が可能です。例：(2 + 3) * 4
          <li>「||」にて文字列連結が可能です。例：'abc' || 'xyz'
          </ul>
          <form name="report_form" id="report_form" action="$base_url$/report/outputFormatReportRegConfirm" method="POST">
            <div class="form-box">
              <table class="data-list table">
                <tr>
                  <th class="t-top">帳票フォーマット名</th>
                  <td class="t-top"><input type="text" name="report_format_name" value=""></td>
                </tr>
              </table>
              <table class="data-list table">
                <tr>
                  <th class="t-top">INSERT</th>
                  <th class="t-top">UPDATE</th>
                  <th class="t-top">DELETE</th>
                </tr>
                <tr>
                  <td class="t-top">
                    <input id="insert" type="hidden" name="insert" value="">
                    <input id="radio_insert" type="radio" name="radio" value="">
                  </td>
                  <td class="t-top">
                    <input id="update" type="hidden" name="update" value="">
                    <input id="radio_update" type="radio" name="radio" value="">
                  </td>
                  <td class="t-top">
                    <input id="delete" type="hidden" name="delete" value="">
                    <input id="radio_delete" type="radio" name="radio" value="">
                  </td>
                </tr>
              </table>
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
                  <!--cols-begin-->
                  <tr>
                    <td class="no">x</td>
                    <td class="td-col">
                      <span class="upList btn-sm btn-primary">↑</span>
                      <span class="downList btn-sm btn-primary">↓</span>
                      <span class="addList btn-sm btn-primary">+</span>
                      <span class="removeList btn-sm btn-primary">-</span>
                    </td>
                    <td class="td-col">
                      <select class="changeList">
                        <option value="" selected>選択してください
                        <option value="テーブルA.項目1">項目1</option>
                        <option value="テーブルA.項目2">項目2</option>
                        <option value="テーブルA.項目3">項目3</option>
                        <option value="テーブルA.項目4">項目4</option>
                        <option value="テーブルA.項目5">項目5</option>
                        <option value="テーブルB.項目6">項目6</option>
                        <option value="テーブルB.項目7">項目7</option>
                        <option value="テーブルB.項目8">項目8</option>
                        <option value="テーブルB.項目9">項目9</option>
                      </select>
                    </td>
                    <td class="td-col"><input type="text" name="cols" size="40" value=""></td>
                  </tr>
                  <!--cols-end-->
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
                <input name="_submit" type="submit" value="　確　認　" onClick="return transfer() && chkArgs(argInfos['outputFormatReportRegConfirm'], report_form);">
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
    var i = 0;
    $(".no").each(function() {
      $(this).html(i++);
    });
  }
  $(document).ready(function() {
    renumber();
  });
</script>
@endsection

  @foreach ($required_columns as $val)
  <tr>
    <td class="no">x</td>
    <td class="td-col">
      <span class="upList btn-sm btn-primary">↑</span>
      <span class="downList btn-sm btn-primary">↓</span>
      <span class="addList btn-sm btn-primary">+</span>
      <span class="removeList btn-sm btn-primary">-</span>
    </td>
    <td class="td-col">
      <select class="changeList form-control">
        <option value="" selected>選択してください
        <option value="テーブルA.項目1" {{$val['name'] == '項目1' ? 'selected' : ''}}>項目1</option>
        <option value="テーブルA.項目2" {{$val['name'] == '項目2' ? 'selected' : ''}}>項目2</option>
        <option value="テーブルA.項目3" {{$val['name'] == '項目3' ? 'selected' : ''}}>項目3</option>
        <option value="テーブルA.項目4" {{$val['name'] == '項目4' ? 'selected' : ''}}>項目4</option>
        <option value="テーブルA.項目5" {{$val['name'] == '項目5' ? 'selected' : ''}}>項目5</option>
        <option value="テーブルB.項目6" {{$val['name'] == '項目6' ? 'selected' : ''}}>項目6</option>
        <option value="テーブルB.項目7" {{$val['name'] == '項目7' ? 'selected' : ''}}>項目7</option>
        <option value="テーブルB.項目8" {{$val['name'] == '項目8' ? 'selected' : ''}}>項目8</option>
        <option value="テーブルB.項目9" {{$val['name'] == '項目9' ? 'selected' : ''}}>項目9</option>
      </select>
    </td>
    <td class="td-col"><input type="text" class="form-control" name="cols" size="40" value={{$val['val'] ?: ''}}></td>
  </tr>
  @endforeach
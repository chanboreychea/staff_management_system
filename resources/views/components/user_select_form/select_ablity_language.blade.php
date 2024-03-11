<select name="{{ $name }}[]" class="form-select form-select-sm">
    <option value="1" {{ in_array('1', old($name, [])) ? 'selected' : '' }}>ល្អណាស់</option>
    <option value="2" {{ in_array('2', old($name, [])) ? 'selected' : '' }}>ល្អបង្គួរ</option>
    <option value="3" {{ in_array('3', old($name, [])) ? 'selected' : '' }}>ល្អ</option>
</select>

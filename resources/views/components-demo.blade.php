<x-input name="name" placeholder="Name" /><br>
<x-input-date name="dob" /><br>
<x-file-uploader name="resume" /><br>
<x-button>Submit</x-button><br><br>
<x-search />
<x-pagination :data="$data ?? collect()" /><br>
<x-rating :rating="3" /><br>
<x-action-dropdown /><br>
<x-phone-input /><br>
<x-address /><br>


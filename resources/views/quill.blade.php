<div x-data="{lequill : null ,
toolbarOptions : [
   ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
   ['blockquote', 'code-block'],

   [{ 'header': 1 }, { 'header': 2 }],               // custom button values
   [{ 'list': 'ordered'}, { 'list': 'bullet' }],
   [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
   [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
   [{ 'direction': 'rtl' }],                         // text direction

   [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
   [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
   [ 'link', 'image', 'video', 'formula' ],          // add's image support
   [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
   [{ 'font': [] }],
   [{ 'align': [] }],

   ['clean']                                         // remove formatting button
   ],
   content : $wire.entangle('annabaFields.{{$field}}'),

init() {

var that = this ;

this.quill = new Quill('#quill-{{$field}}', {
modules: {
   toolbar: that.toolbarOptions
},
theme: 'snow'
});



if($wire.annabaFields.{{$field}} == null) {
this.content = '';
}

this.quill.root.innerHTML = this.content;  


$watch('content', value => {
if($wire.annabaFields.{{$field}} == null) {
this.content = '';
 this.quill.root.innerHTML = this.content;
}
});


this.quill.on('text-change', function(delta, oldDelta, source) {
if (that.quill.root.innerHTML === '<p><br></p>') {
that.quill.root.innerHTML = ''; 
}
that.content = that.quill.root.innerHTML; 
});


},

}">

<div class="w-full mb-[5px]">
<span class="text-[darkblue] font-bold">{{$label}}</span><span class="text-[red]">@if($required==true)*@endif</span> 
</div>
<div wire:ignore>
<div  id="quill-{{$field}}" class="bg-white min-h-[200px]"></div>
</div>

@error("annabaFields.$field")
<div class="text-[red] pt-[5px]">
<span class="error">{{ $message }}</span> 
</div>
@enderror


</div>
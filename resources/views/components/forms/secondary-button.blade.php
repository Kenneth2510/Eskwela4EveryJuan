<button {{$attributes->merge(['class'=>'flex flex-row items-center justify-center w-24 h-10 m-2 bg-gray-400 rounded-lg hover:bg-gray-500 md:h-12'])}}>
    <h1>{{$name}}</h1>
    {{$slot}}
</button>
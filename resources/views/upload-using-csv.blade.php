@extends('layouts.frontend')
@section('title', 'Upload posts with')
@section('frontend-content')
<div>
    <div class="d-flex justify-content-between border-bottom">
        <h4 class="pb-2 mb-3">Upload posts using CSV file</h4>
        <div class="float-right">
            <a href="/posts/csv-download" class="btn btn-info">Download sample</a>
        </div>
    </div>
    <div class="w-75 mx-auto my-5">
        <div class="card-body text-center">
            <form action="/posts/upload-using-csv" method="POST" enctype="multipart/form-data">
                @csrf
               @error('csv')
                   <div class="alert alert-danger">{{ $message }}</div>
               @enderror
                <div id="drop_zone" class="csv-card py-5 position-relative" ondrop="() => console.log('ok');" ondragover="event => event.preventDefault();">
                    <div id="close-preview-file-btn" class="d-none btn btn-danger btn-sm">&times;</div>
                    <div>
                        <img id="preview-img" class="d-none" src="{{asset('assets/images/file.png')}}" alt="file" width="100" height="100">
                        <p id="preview-img-info"></p>
                    </div>
                    <div id="upload-form" class="">
                        <p>Drag and drop your .csv file</p>
                        <p>OR</p>
                        <div>
                            <label for="csv-input" class="btn btn-outline-info">Upload file</label>
                            <input type="file" id="csv-input" name="csv" class="d-none">
                        </div>
                    </div>
                </div>
                <div class="input-group text-center justify-content-center my-4">
                    <button class="btn btn-success">Create posts</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{asset('assets/js/csv_file_upload.js')}}"></script>
@endsection

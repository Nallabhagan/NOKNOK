@extends('layouts.app')
@section('social-media-meta-tags')
	<title>NOKNOK | GIVE YOUR INTERVIEW </title>
@endsection
@section('content')

	<div class="container"> 
        <div class="row">
        	<div class="col-xl-12">
				<div class="utf-section-headline-item centered margin-top-0 margin-bottom-40">
					<span>NOKNOK</span>
					<h3>Give Your Interview</h3>
					
					<p class="utf-slogan-text">Below are some of the interview questions under various subjects. Please give your interview by answering the questions under each interview.</p>
				</div>
			</div>
		</div>
		<x-give-interview />
	</div>
@endsection
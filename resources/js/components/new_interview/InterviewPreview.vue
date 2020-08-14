<template>
	<div class="utf-popup-tab-content-item" id="register">
	    <div class="utf-welcome-text-item">
	        <h3>{{ $store.state.interviewTitle }}</h3>
	        <span>{{ $store.state.interviewDescription }}</span> 
	    </div>
	    <div class="utf-submit-field" v-for="question in $store.state.interviewQuestions" :key="question" v-if="$store.state.interviewQuestions.length">
	        <h5>{{ question }}</h5>
	        <input type="text" class="utf-with-border">
	    </div>
	</div>
</template>
<script setup>
import { component as  CKEditor } from '@ckeditor/ckeditor5-vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
</script>

<template>
    <CKEditor :editor="ClassicEditor" />
</template>
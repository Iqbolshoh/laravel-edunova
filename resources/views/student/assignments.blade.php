@extends('layouts.dashboard')

@section('title', 'Vazifalar')
@section('header_title', 'Uyga vazifalar')

@section('content')
<div class="space-y-6" x-data="assignmentEditor()">

    <div class="flex items-center justify-between mb-2">
        <h2 class="text-2xl font-bold text-white">Vazifani bajarish</h2>
    </div>

    <div class="bg-slate-800/50 border border-white/5 rounded-2xl p-6 backdrop-blur-sm">

        <div class="flex space-x-4 mb-6 border-b border-white/10 pb-4">
            <button @click="activeTab = 'word'"
                :class="activeTab === 'word' ? 'bg-blue-600 text-white' : 'bg-slate-700 text-slate-300 hover:bg-slate-600'"
                class="px-5 py-2.5 rounded-xl text-sm font-medium transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Word Editor
            </button>
            <button @click="activeTab = 'excel'"
                :class="activeTab === 'excel' ? 'bg-emerald-600 text-white' : 'bg-slate-700 text-slate-300 hover:bg-slate-600'"
                class="px-5 py-2.5 rounded-xl text-sm font-medium transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                </svg>
                Excel Editor
            </button>
        </div>

        <form id="assignmentSubmitForm" action="#" method="POST">
            @csrf

            <input type="hidden" name="word_content" id="word_content">
            <input type="hidden" name="excel_content" id="excel_content">
            <input type="hidden" name="assignment_type" :value="activeTab">

            <div x-show="activeTab === 'word'" style="display: none;">
                <label class="block text-sm font-semibold text-slate-300 mb-2">Word / Matn muharriri</label>
                <div id="wordEditor"></div>
            </div>

            <div x-show="activeTab === 'excel'" style="display: none;">
                <label class="block text-sm font-semibold text-slate-300 mb-2">Excel / Jadval muharriri</label>
                <div class="overflow-x-auto rounded-xl border border-white/10">
                    <div id="excelEditor"></div>
                </div>
            </div>

            <div class="flex justify-end mt-6 pt-6 border-t border-white/5">
                <button type="button" @click="submitAssignment()" class="bg-blue-600 hover:bg-blue-500 text-white px-8 py-3 rounded-xl text-sm font-bold transition-colors shadow-lg shadow-blue-500/30">
                    Vazifani yuborish
                </button>
            </div>
        </form>
    </div>
</div>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script src="https://bossanova.uk/jspreadsheet/v4/jexcel.js"></script>
<script src="https://jsuites.net/v4/jsuites.js"></script>
<link rel="stylesheet" href="https://bossanova.uk/jspreadsheet/v4/jexcel.css" type="text/css" />
<link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css" />

<style>
    /* -----------------------------------------
       Word Editor (Quill) Dark Theme Customization
       ----------------------------------------- */
    .ql-toolbar.ql-snow {
        background-color: #1e293b;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: 0.75rem 0.75rem 0 0;
    }

    .ql-container.ql-snow {
        background-color: #0f172a;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-top: none;
        border-radius: 0 0 0.75rem 0.75rem;
        color: white;
        font-size: 15px;
    }

    .ql-editor {
        color: white;
        padding: 20px;
        min-height: 400px;
    }

    .ql-editor.ql-blank::before {
        color: #64748b !important;
        font-style: normal;
    }

    .ql-snow .ql-stroke {
        stroke: #94a3b8;
    }

    .ql-snow .ql-fill {
        fill: #94a3b8;
    }

    .ql-snow button:hover .ql-stroke {
        stroke: #fff;
    }

    .ql-snow button.ql-active .ql-stroke {
        stroke: #3b82f6;
    }

    .ql-snow .ql-picker-label {
        color: #94a3b8;
    }

    .ql-snow .ql-picker-label:hover {
        color: #fff;
    }

    .ql-snow .ql-picker-label.ql-active {
        color: #3b82f6;
    }

    .ql-snow .ql-picker-options {
        background-color: #1e293b;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .ql-snow .ql-picker-item {
        color: #94a3b8;
    }

    .ql-snow .ql-picker-item:hover {
        color: #fff;
        background-color: #334155;
    }

    /* -----------------------------------------
       Excel Editor (Jspreadsheet) Dark Theme
       ----------------------------------------- */
    .jexcel_container {
        font-family: inherit;
        width: 100% !important;
    }

    .jexcel {
        background-color: #0f172a !important;
        color: white !important;
        border-collapse: collapse;
        width: 100% !important;
    }

    /* Table Headers (A, B, C... & 1, 2, 3...) */
    .jexcel thead td,
    .jexcel tbody td.jexcel_row {
        background-color: #1e293b !important;
        color: #94a3b8 !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        font-weight: 600;
        text-align: center;
    }

    /* Table Cells */
    .jexcel tbody td {
        background-color: #0f172a !important;
        color: #f8fafc !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        padding: 4px 8px;
    }

    /* Selected Cell / Highlight */
    .jexcel tbody td.highlight {
        background-color: #3b82f6 !important;
        color: white !important;
    }

    /* Editing Cell */
    .jexcel>tbody>tr>td.edition {
        background-color: #1e293b !important;
        color: white !important;
        outline: 2px solid #3b82f6 !important;
    }

    /* Context Menu */
    .jcontextmenu {
        background-color: #1e293b !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: #f8fafc !important;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.5);
    }

    .jcontextmenu div:hover {
        background-color: #334155 !important;
    }
</style>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('assignmentEditor', () => ({
            activeTab: 'word',
            wordInstance: null,
            excelInstance: null,

            init() {
                // Initialize Word Editor (Quill)
                this.wordInstance = new Quill('#wordEditor', {
                    theme: 'snow',
                    placeholder: 'Vazifani bu yerga yozing...',
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline', 'strike'],
                            ['blockquote', 'code-block'],
                            [{
                                'header': [1, 2, 3, false]
                            }],
                            [{
                                'list': 'ordered'
                            }, {
                                'list': 'bullet'
                            }],
                            [{
                                'color': []
                            }, {
                                'background': []
                            }],
                            [{
                                'align': []
                            }],
                            ['link', 'image'],
                            ['clean']
                        ]
                    }
                });

                // Initialize Excel Editor (Jspreadsheet)
                this.excelInstance = jspreadsheet(document.getElementById('excelEditor'), {
                    minDimensions: [10, 15], // 10 columns, 15 rows default
                    defaultColWidth: 100,
                    // Removed the static style parameter to allow CSS dark theme to take over
                });
            },

            submitAssignment() {
                // Get data from Word editor
                const wordData = this.wordInstance.root.innerHTML;
                document.getElementById('word_content').value = wordData;

                // Get data from Excel editor as JSON
                const excelData = JSON.stringify(this.excelInstance.getData());
                document.getElementById('excel_content').value = excelData;

                // Submit the form
                document.getElementById('assignmentSubmitForm').submit();
            }
        }));
    });
</script>
@endsection
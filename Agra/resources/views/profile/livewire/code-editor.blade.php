<div class="wrapper">
    <h1 class="text-2xl mb-5">Test your code</h1>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
    <div class="flex">
        <div class="w-1/2 mr-2">
            <div id="code-editor" wire:model="code" class="w-full h-96 overflow-auto border rounded-md shadow-sm"></div>
            <br>
            <button id="runButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" style="background-color: #0B6125" onclick="runCode()">
                Run
            </button>
        </div>
        <div class="w-1/2 ml-2">
            <h2 class="text-xl mb-5" style="margin-left: 20px;">Output</h2>
            <div class="output" id="output" style="padding: 10px;margin-left: 20px;height: 300px; background-color: #282c34; overflow: scroll; border: 1px solid white; border-radius: 10px;"></div>
        </div>
    </div>



    <script>
        let editor = ace.edit("code-editor");
        editor.setTheme("ace/theme/one_dark");
        editor.session.setMode("ace/mode/java"); // Adjust mode as needed (e.g., "ace/mode/python")
        editor.setShowPrintMargin(false);
        editor.setAutoScrollEditorIntoView(true);
        editor.resize();
        editor.setOptions({
            fontSize: "20px"
        });

        function runCode() {
            let code = editor.getValue();
            axios.post('/execute-code', {
                script: code
            })
                .then(function(response) {
                    console.log(response);
                    let output = response.data.replace(/\n/g, "<br>");
                    document.getElementById("output").innerHTML = "<p>" + output + "</p>";
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    </script>
</div>

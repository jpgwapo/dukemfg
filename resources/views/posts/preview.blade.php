@include('includes.header')

    <div style="width: 900px;" class="container max-w-full mx-auto pt-4">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="grid grid-cols-2 gap-2">
                    <div class="overflow-hidden sm:rounded-lg">
                        <div class="box-border h-52 w-52 p-4 border-4">
                            <p>R1C1</p>
                            <button {{$position == "r1c1" ? 'disabled' : ''}} class="modal-open bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" id="r1c1">
                                <span> {{$position == "r1c1" ? 'Occupied' : 'Available'}}</span>
                            </button>
                        </div>
                    </div>                    
                    <div class="overflow-hidden sm:rounded-lg">
                        <div class="box-border h-52 w-52 p-4 border-4">
                            <p>R1C2</p>
                            <button {{$position == "r2c2" ? 'disabled' : ''}} class="modal-open bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" id="r1c2">
                                <span> {{$position == "r1c2" ? 'Occupied' : 'Available'}}</span>
                            </button>
                        </div>
                    </div>
                    <div class="overflow-hidden sm:rounded-lg">
                        <div class="box-border h-52 w-52 p-4 border-4">
                            <p>R2C1</p>
                            <button {{$position == "r2c1" ? 'disabled' : ''}} class="modal-open bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" id="r2c1">
                                <span> {{$position == "r2c1" ? 'Occupied' : 'Available'}}</span>
                            </button>
                        </div>
                    </div>                    
                    <div class="overflow-hidden sm:rounded-lg">
                        <div class="box-border h-52 w-52 p-4 border-4">
                            <p>R2C2</p>
                            <button {{$position == "r2c2" ? 'disabled' : ''}} class="modal-open bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" id="r2c2">
                                <span> {{$position == "r2c2" ? 'Occupied' : 'Available'}}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- pop up dialog --}}
    <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
          
          <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
            <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
            <span class="text-sm">(Esc)</span>
          </div>
    
          <!-- Add margin if you want to see some of the overlay behind the modal-->
          <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
              <p class="text-2xl font-bold">Status</p>
              <div class="modal-close cursor-pointer z-50">
                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                  <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>
              </div>
            </div>
    
            <!--Body-->
            <form>
                <select name="status" id="status">
                    <option value="available">Available</option>
                    <option value="reserved">Reserved</option>
                    <option value="unavailable">Unavailable</option>
                    <option value="occupied">Occupied </option>
                </select>
                <br><br>
            </form>
    
            <!--Footer-->
            <div class="flex justify-end pt-2">
              <button id="update_data" class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Submit</button>
              <button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Cancel</button>
            </div>
          </div>
        </div>
      </div>


    <script>
        var openmodal = document.querySelectorAll('.modal-open')
        for (var i = 0; i < openmodal.length; i++) {
          openmodal[i].addEventListener('click', function(event){
            event.preventDefault()
            let position = this.id
            toggleModal(position)
          })
        }
        
        var closemodal = document.querySelectorAll('.modal-close')
        for (var i = 0; i < closemodal.length; i++) {
          closemodal[i].addEventListener('click', toggleModal)
        }

        function toggleModal (position) {
            const body = document.querySelector('body')
            const modal = document.querySelector('.modal')
            modal.classList.toggle('opacity-0')
            modal.classList.toggle('pointer-events-none')
            body.classList.toggle('modal-active')

            let positions = position
            $(document).on("click", "#update_data", function() {
                let url = "{{URL('/post/updateStatus')}}";
                $.ajax({
                    url: url,
                    type: "PUT",
                    cache: false,
                    data:{
                        _token:'{{ csrf_token() }}',
                        status: $('#status').val(),
                        id: {{$posts->id}},
                        position: positions,
                    },
                    success: function(data){
                        console.log(data)
                        if(data.statusCode)
                        {
                            window.location = "/posts";
                        }
                        else{
                            alert("Internal Server Error");
                        }
                    }
                });
            }); 
        }
    </script>
</body>
</html>

<form id="searchform" name="searchform">
    @csrf
    <div class="row justify-content-between align-items-center">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="search" class="form-label">Search</label>
                <input type="text" autocomplete="off" placeholder="Search by name,email or phone" class="form-control" id="search" name="search">
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="filter" class="form-label">Filter By</label>
                <select id="filter" name="filter" class="form-select">
                  <option value=""></option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                  <option value="E">E</option>
                  <option value="F">F</option>
                  <option value="G">G</option>
                  <option value="H">H</option>
                  <option value="I">I</option>
                  <option value="J">J</option>
                  <option value="K">K</option>
                  <option value="L">L</option>
                  <option value="M">M</option>
                  <option value="N">N</option>
                  <option value="O">O</option>
                  <option value="P">P</option>
                  <option value="Q">Q</option>
                  <option value="R">R</option>
                  <option value="S">S</option>
                  <option value="T">T</option>
                  <option value="U">U</option>
                  <option value="V">V</option>
                  <option value="W">W</option>
                  <option value="X">X</option>
                  <option value="Y">Y</option>
                  <option value="Z">Z</option>
                </select>
            </div>
        </div>
    </div>
</form>
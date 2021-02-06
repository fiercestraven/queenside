<!DOCTYPE html>
<html lang="en">

<head>
    <?php   
       include("../_partials/head.html");
    ?>
</head>

<body>
    <!-- logo and nav -->
   <?php
        include("../_partials/nav.html");
   ?>

    <!-- Filtering options for player listings -->
    <div class="container my-container">
        <div class="row">
            <div class="col-3">
                <button type="button" class="btn dropdown-toggle my-filter-button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Search Filters
                </button>
                <div class="dropdown-menu my-filter-menu">
                    <form class="px-4 py-3">
                        <div class="mb-3">
                            <!-- FIDE ID -->
                            <div class="row mb-3">
                                <label for="inputFIDE" class="col-sm-2 col-form-label">FIDE ID</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="e.g., 5000123" id="inputFIDE">
                                </div>
                            </div>

                            <!-- Player name -->
                            <div class="row mb-3">
                                <label for="inputPlayerName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"
                                        placeholder="Enter all or part of the player's name" id="inputPlayerName">
                                </div>
                            </div>

                            <!-- Federation -->
                            <div class="row mb-3">
                                <label for="inputFederation" class="col-sm-2 col-form-label">Federation</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Player's home country"
                                        id="inputFederation">
                                </div>
                            </div>

                            <!-- Player title -->
                            <div class="row mb-3">
                                <label for="inputPlayerTitle" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Dropdown selection for player title">
                                        <option selected>Select</option>
                                        <option value="1">Grandmaster</option>
                                        <option value="2">Woman Grandmaster</option>
                                        <option value="3">International Master</option>
                                        <option value="4">International Arbiter</option>
                                        <option value="5">FIDE Arbiter</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Player status -->
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Include inactive players?</legend>
                                <div class="col-sm-10">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="flexSwitchCheck" id="switch"
                                            value="option1">
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Form submission -->
                            <button type="submit" class="btn btn-secondary">Apply</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sorting options for player list -->
            <div class="col-6"></div>
            <div class="col-3">
                <button type="button" class="btn dropdown-toggle my-sort-button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Sort by
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">FIDE ID</a></li>
                    <li><a class="dropdown-item" href="#">Name</a></li>
                    <li><a class="dropdown-item" href="#">Federation</a></li>
                    <li><a class="dropdown-item" href="#">Birth Year</a></li>
                    <li><a class="dropdown-item" href="#">Title</a></li>
                    <li><a class="dropdown-item" href="#">Standard Rating</a></li>
                    <li><a class="dropdown-item" href="#">Rapid Rating</a></li>
                    <li><a class="dropdown-item" href="#">Blitz Rating</a></li>
                    <li><a class="dropdown-item" href="#">Active Status</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- player table, currently w/ dummy data -->
    <div class="container my-container">
        <h2>Internationally Ranked Women Chess Players</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">FIDE ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Federation (Country)</th>
                    <th scope="col">Birth Year</th>
                    <th scope="col">Chess Title</th>
                    <th scope="col">Standard Rating</th>
                    <th scope="col">Rapid Rating</th>
                    <th scope="col">Blitz Rating</th>
                    <th scope="col">Active</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>5008123</td>
                    <td><a class="my-light-link" href="playerdetail.php">Koneru, Humpy</a></td>
                    <td>India</td>
                    <td>1987</td>
                    <td>Grandmaster</td>
                    <td>2586</td>
                    <td>2483</td>
                    <td>2483</td>
                    <td>Yes</td>
                </tr>
                <tr>
                    <td>16340801 5729</td>
                    <td>Valencia, Jolina X.</td>
                    <td>Cape Verde</td>
                    <td>1964</td>
                    <td>lacus</td>
                    <td>2630</td>
                    <td>1706</td>
                    <td>2027</td>
                    <td>No</td>
                </tr>
                <tr>
                    <td>16171219 6797</td>
                    <td>Conway, Emery N.</td>
                    <td>Burundi</td>
                    <td>1981</td>
                    <td>Phasellus</td>
                    <td>2452</td>
                    <td>1604</td>
                    <td>2495</td>
                    <td>Yes</td>
                </tr>
                <tr>
                    <td>16000817 0029</td>
                    <td>Gay, Rachael K.</td>
                    <td>Turkey</td>
                    <td>1954</td>
                    <td>luctus</td>
                    <td>2126</td>
                    <td>1813</td>
                    <td>1620</td>
                    <td>No</td>
                </tr>
                <tr>
                    <td>16270224 3425</td>
                    <td>Barker, Maris X.</td>
                    <td>Venezuela</td>
                    <td>1950</td>
                    <td>quam</td>
                    <td>2311</td>
                    <td>2628</td>
                    <td>1344</td>
                    <td>No</td>
                </tr>
                <tr>
                    <td>16130918 6557</td>
                    <td>Nixon, Hayley Y.</td>
                    <td>Syria</td>
                    <td>1991</td>
                    <td>lectus</td>
                    <td>2145</td>
                    <td>2541</td>
                    <td>2238</td>
                    <td>Yes</td>
                </tr>
                <tr>
                    <td>16940823 5829</td>
                    <td>Daniels, Zia V.</td>
                    <td>Botswana</td>
                    <td>1978</td>
                    <td>pretium</td>
                    <td>2475</td>
                    <td>2239</td>
                    <td>2458</td>
                    <td>No</td>
                </tr>
                <tr>
                    <td>16410614 8424</td>
                    <td>Fuentes, Blina C.</td>
                    <td>Niger</td>
                    <td>1996</td>
                    <td>arcu</td>
                    <td>1888</td>
                    <td>2291</td>
                    <td>1682</td>
                    <td>No</td>
                </tr>
                <tr>
                    <td>16170201 0024</td>
                    <td>Bennett, Abra W.</td>
                    <td>Libya</td>
                    <td>1963</td>
                    <td>lobortis</td>
                    <td>2377</td>
                    <td>1480</td>
                    <td>2316</td>
                    <td>Yes</td>
                </tr>
                <tr>
                    <td>16391110 7229</td>
                    <td>Guerrero, Breanna P.</td>
                    <td>Cuba</td>
                    <td>1962</td>
                    <td>sollicitudin</td>
                    <td>1872</td>
                    <td>1525</td>
                    <td>1854</td>
                    <td>No</td>
                </tr>
                <tr>
                    <td>16730202 7748</td>
                    <td>Byrd, Priscilla D.</td>
                    <td>Marshall Islands</td>
                    <td>1984</td>
                    <td>rutrum</td>
                    <td>1933</td>
                    <td>2152</td>
                    <td>1939</td>
                    <td>No</td>
                </tr>
                <tr>
                    <td>16390309 9541</td>
                    <td>Ochoa, Delilah D.</td>
                    <td>San Marino</td>
                    <td>1970</td>
                    <td>ut</td>
                    <td>1896</td>
                    <td>2608</td>
                    <td>1616</td>
                    <td>Yes</td>
                </tr>
                <tr>
                    <td>16731003 4967</td>
                    <td>Fulton, Yvette P.</td>
                    <td>Dominican Republic</td>
                    <td>1970</td>
                    <td>at</td>
                    <td>2205</td>
                    <td>1258</td>
                    <td>1159</td>
                    <td>No</td>
                </tr>
                <tr>
                    <td>16201030 8746</td>
                    <td>Orr, Adria X.</td>
                    <td>Germany</td>
                    <td>1964</td>
                    <td>orci</td>
                    <td>1927</td>
                    <td>1804</td>
                    <td>2684</td>
                    <td>Yes</td>
                </tr>
                <tr>
                    <td>16441210 3303</td>
                    <td>Mccarthy, Brandy H.</td>
                    <td>Guinea</td>
                    <td>1977</td>
                    <td>libero</td>
                    <td>2208</td>
                    <td>2345</td>
                    <td>2295</td>
                    <td>Yes</td>
                </tr>
                <tr>
                    <td>16390430 1656</td>
                    <td>Ramsey, Wing W.</td>
                    <td>Sierra Leone</td>
                    <td>1991</td>
                    <td>hymenaeos.</td>
                    <td>2118</td>
                    <td>1881</td>
                    <td>1418</td>
                    <td>Yes</td>
                </tr>
                <tr>
                    <td>16660420 7867</td>
                    <td>Preston, Oprah P.</td>
                    <td>Cuba</td>
                    <td>1975</td>
                    <td>accumsan</td>
                    <td>2291</td>
                    <td>1766</td>
                    <td>2646</td>
                    <td>Yes</td>
                </tr>
                <tr>
                    <td>16760422 7665</td>
                    <td>Alford, Uma G.</td>
                    <td>Cape Verde</td>
                    <td>1990</td>
                    <td>amet</td>
                    <td>2011</td>
                    <td>1287</td>
                    <td>1403</td>
                    <td>No</td>
                </tr>
                <tr>
                    <td>16550809 8935</td>
                    <td>Lloyd, Risa C.</td>
                    <td>Equatorial Guinea</td>
                    <td>1971</td>
                    <td>velit</td>
                    <td>2583</td>
                    <td>1280</td>
                    <td>1911</td>
                    <td>Yes</td>
                </tr>
            </tbody>
        </table>

        <!-- pagination: will implement when real data is present -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-end">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Footer -->
    <?php
        include("../_partials/footer.html");
    ?>  

    <!-- JS Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>

</body>

</html>
@extends('layouts.user_type.auth')

@section('content')
    <div class="main-content position-relative bg-gray-100">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12 col-12">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 text-start">
                                    <h6 class="mb-0">Alteração de custo de produto</h6>
                                </div>
                                <div class="col-6 text-end"><button onclick="getLogs();" class="btn btn-primary">Ver
                                        Logs</button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="selectedStoreData">
                        <input type="hidden" id="user_id" value="{{ $user->id }}">
                        <div class="card-body pb-0">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder">Selecione uma loja</h6>
                            <input class="form-control mb-3" type="text" id="storeInput" autocomplete="off">
                            <ul id="storeList">

                            </ul>
                        </div>
                        <div class="card-body pt-0" id="productSearch" style="display:none">
                            <input class="form-control mb-3" type="text" id="productInput"
                                placeholder="Buscar produto..." autocomplete="off">
                            <table id="productTable" style="display:none">

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-8">
            </div>
        </div>
    </div>
@endsection

<script>
    var token = 'api';
    const saveProductApi = '{{ env('APP_URL') }}api/save-product';
    const stockProductsApiUrl = '{{ env('APP_URL') }}api/store-stock';
    const suppliersApiUrl = '{{ env('APP_URL') }}api/suppliers-list';
    const productUniqueApiUrl = '{{ env('APP_URL') }}api/store-prods-unique';
    const apiGetLogs = '{{ env('APP_URL') }}api/get-logs';

    document.addEventListener('DOMContentLoaded', () => {
        const storesApiUrl = '{{ env('APP_URL') }}api/firebird-connections';
        const productsApiUrl = '{{ env('APP_URL') }}api/store-prods';

        const storeInput = document.getElementById("storeInput");
        const storeList = document.getElementById("storeList");
        const productInput = document.getElementById("productInput");
        const productTable = document.getElementById("productTable").getElementsByTagName("tbody")[0];

        let stores = [];

        async function getStores() {
            const response = await fetch(storesApiUrl, {
                headers: {
                    'Authorization': `Bearer ${token}`
                },
            });
            const result = await response.json();
            stores = result;
        }

        function createListItem(store) {
            const li = document.createElement("li");
            li.classList.add("store");
            li.setAttribute("data-store-id", store.store_id);
            li.setAttribute("data-store-db", store.dbhost);
            li.setAttribute("data-store-server", store.server);
            li.innerText = store.title;
            return li;
        }

        function clearStoreList() {
            while (storeList.firstChild) {
                storeList.removeChild(storeList.firstChild);
            }
        }

        function selectItem(li) {
            const selectedStoreId = li.getAttribute("data-store-id");
            const selectedStoreDb = li.getAttribute("data-store-db");
            const selectedStoreServer = li.getAttribute("data-store-server");

            const selectedStore = stores.find(
                (store) => store.store_id === selectedStoreId
            );

            storeInput.value = selectedStore.title;
            clearStoreList();

            // Remove the "selected" class from all store items
            const storeItems = document.querySelectorAll(".store");
            storeItems.forEach((storeItem) => {
                storeItem.classList.remove("selected");
            });

            // Add the "selected" class to the selected store item
            li.classList.add("selected");

            // Show the product search section
            document.getElementById("productSearch").style.display = "none";
            document.getElementById("productTable").style.display = "none";
        }

        async function searchStores() {
            const searchTerm = storeInput.value.toLowerCase();

            if (stores.length > 0) {
                const filteredStores = stores.filter((store) =>
                    store.title.toLowerCase().includes(searchTerm)
                );
                clearStoreList();
                filteredStores.forEach((store) => {
                    const li = createListItem(store);
                    storeList.appendChild(li);
                });
            }

            const storeItems = document.querySelectorAll('#storeList li');
            let selectedItem = null;

            storeItems.forEach(function(item) {
                item.addEventListener('click', function() {
                    storeInput.value = item.innerText;
                    selectedItem = null;
                    storeItems.forEach(function(item) {
                        item.classList.remove('selected');
                    });
                    clearStoreList();
                    var id = item.getAttribute('data-store-id');
                    var db = item.getAttribute('data-store-db');
                    var server = item.getAttribute('data-store-server');
                    selectedStoreId(id, db, server);
                });

                item.addEventListener('mouseenter', function() {
                    storeItems.forEach(function(item) {
                        item.classList.remove('selected');
                    });
                    item.classList.add('selected');
                    selectedItem = item;
                });

                item.addEventListener('mouseleave', function() {
                    item.classList.remove('selected');
                    selectedItem = null;
                });
            });


        }

        storeInput.addEventListener("focus", () => {
            document.getElementById("productSearch").style.display = "none";
            document.getElementById("productTable").style.display = "none";
            product = document.getElementById("selectedStoreData");
            product.removeAttribute('data-store-id');
            product.removeAttribute('data-store-db');
            product.removeAttribute('data-store-server');
            if (DataTable.isDataTable('#productTable')) {
                const productTable = $('#productTable').DataTable();
                productTable.destroy();
            }
            productsFromApi = null;
            storeInput.value = "";
            productInput.value = "";
            clearStoreList();
        });

        storeInput.addEventListener("input", searchStores);

        storeInput.addEventListener('keydown', function(event) {
            let selectedItem = document.querySelector('.store.selected');
            const storeItems = document.querySelectorAll('.store');

            if (event.key === 'ArrowDown') {
                if (!selectedItem) {
                    selectedItem = storeItems[0];
                } else if (selectedItem.nextSibling) {
                    selectedItem = selectedItem.nextSibling;
                }
                storeItems.forEach(function(item) {
                    item.classList.remove('selected');
                });
                selectedItem.classList.add('selected');
            } else if (event.key === 'ArrowUp') {
                if (!selectedItem) {
                    selectedItem = storeItems[storeItems.length - 1];
                } else if (selectedItem.previousSibling) {
                    selectedItem = selectedItem.previousSibling;
                }
                storeItems.forEach(function(item) {
                    item.classList.remove('selected');
                });
                selectedItem.classList.add('selected');
            } else if (event.key === 'Enter' && selectedItem) {
                var id = selectedItem.getAttribute('data-store-id');
                var db = selectedItem.getAttribute('data-store-db');
                var server = selectedItem.getAttribute('data-store-server');
                selectedStoreId(id, db, server);
                storeInput.value = selectedItem.innerText;
                clearStoreList();
                selectedItem = null;
                storeItems.forEach(function(item) {
                    item.classList.remove('selected');
                });
            }
        });

        function selectedStoreId(id, db, server) {
            storeId = document.getElementById("selectedStoreData");
            storeId.setAttribute('data-store-id', id);
            storeId.setAttribute('data-store-db', db);
            storeId.setAttribute('data-store-server', server);
            document.getElementById("productSearch").style.display = "block";
            document.getElementById("productInput").focus();
        }

        getStores();

        productInput.addEventListener("input", searchProducts);

        let productsFromApi = [];

        async function searchProducts() {
            storeSel = document.getElementById("selectedStoreData");
            var idStore = storeSel.getAttribute('data-store-id');
            var db = storeSel.getAttribute('data-store-db');
            var server = storeSel.getAttribute('data-store-server');
            if (this.value.length > 2) {
                document.getElementById("productTable").style.display = "block";
                getProductsApi(this.value, idStore);
            } else {
                if (DataTable.isDataTable('#productTable')) {
                    const productTable = $('#productTable').DataTable();
                    document.getElementById("productTable").style.display = "none";
                    productTable.clear().destroy();
                }
            }
        }

        async function getProductsApi(product, idStore) {
            var dbStore = storeSel.getAttribute('data-store-db');
            var serverStore = storeSel.getAttribute('data-store-server');

            const response = await fetch(productsApiUrl + '?search=' + product + '&store_id=' + idStore +
                '&dbStore=' + dbStore + '&serverStore=' + serverStore, {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    },
                });
            const result = await response.json();
            makeDatatable(result);
        }

        function makeDatatable(result) {
            // CDPRODUTO, DESCRICAO, VLRSUGERIDO, PROMO, VLRCUSTOCIMP, QUANTIDADE, GIRO, GIRO90D
            if (DataTable.isDataTable('#productTable')) {
                const productTable = $('#productTable').DataTable();
                productTable.destroy();
            }

            const table = $('#productTable').DataTable({
                data: result.data,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json',
                },
                searchable: true,
                columns: [{
                        data: 'CDPRODUTO',
                        title: 'ID'
                    },
                    {
                        title: 'NOME',
                        data: {
                            descricao: 'DESCRICAO',
                            categoria: 'CATEGORIA',
                            lmtdescgerente: 'LMTDESCGERENTE'
                        },
                        render: function(data, type, row) {
                            return '<p class="nameProd">' + data.DESCRICAO +
                                ' <span class="catProd">' + data.CATEGORIA +
                                ' (' + data.LMTDESCGERENTE + ')</span></p>';
                        }
                    },
                    {
                        data: 'VLRSUGERIDO',
                        title: 'VALOR'
                    },
                    {
                        data: 'PROMO',
                        title: 'PROMO'
                    },
                    {
                        data: 'VLRCUSTOCIMP',
                        title: 'CUSTO'
                    },
                    {
                        data: 'MARGEM',
                        title: 'MARGEM'
                    },
                    {
                        data: 'QUANTIDADE',
                        title: 'QTD'
                    },
                    {
                        data: 'GIRO',
                        title: 'GIRO'
                    },
                    {
                        data: 'GIRO90D',
                        title: 'GIRO90D'
                    },
                    {
                        title: 'Ações',
                        data: 'CDPRODUTO',
                        render: function(data, type, row) {
                            var stockProd =
                                '<button class="btn btn-primary w-80 me-2" data-action=\'{"action":"stock", "product_id":"' +
                                data + '"}\' onclick="stockStoresProds(' + data +
                                ')"><i class="fa fa-eye" aria-hidden="true"></i></button>';
                            // var supplyerProd =
                            //     '<button class="btn btn-danger w-80 me-2" data-action=\'{"action":"supply", "product_id":"' +
                            //     data + '"}\' onclick="suppliersStock(' + data +
                            //     ')"><i class="fa fa-list" aria-hidden="true"></i></button>';
                            var supplyerProd =
                                '';
                            var editProd =
                                '<button class="btn btn-success w-80" data-action=\'{"action":"edit", "product_id":"' +
                                data + '"}\' onclick="editProduct(' + data +
                                ')"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
                            return '<div style="display: flex;">' + stockProd + ' ' +
                                supplyerProd + ' ' + editProd + '</div>';
                        }
                    }
                ],
                "sScrollX": "100%",
                "sScrollXInner": "110%",
                "bScrollCollapse": true,
                order: [
                    [5, 'desc']
                ],
                pageLength: 15,
                aLengthMenu: [
                    [15, 25, 50, 100, 200, -1],
                    [15, 25, 50, 100, 200, "Todos"]
                ],
            });

            // wheelTables();

            // productsFromApi.forEach(console.log('asd'));
        }

    });

    // function wheelTables() {
    //     const container = document.getElementsByClassName("dataTables_wrapper");
    //     // console.log(container);
    //     container.addEventListener("wheel", function(e) {
    //         // if (e.deltaY > 0) {
    //         //     container.scrollLeft += 100;
    //         //     e.preventDefault();
    //         // } else {
    //         //     container.scrollLeft -= 100;
    //         //     e.preventDefault();
    //         // }
    //     });
    // }

    async function stockStoresProds(data) {
        const response = await fetch(stockProductsApiUrl + '?product_id=' + data, {
            headers: {
                'Authorization': `Bearer ${token}`
            },
        });
        const result = await response.json();
        makeDatatableModal(result, data);
    }

    async function suppliersStock(data) {
        const response = await fetch(stockProductsApiUrl + '?product_id=' + data, {
            headers: {
                'Authorization': `Bearer ${token}`
            },
        });
        const result = await response.json();
        makeDatatableModalSupply(result, data);
    }

    async function editProduct(product_id) {
        storeSel = document.getElementById("selectedStoreData");
        var idStore = storeSel.getAttribute('data-store-id');

        var dbStore = storeSel.getAttribute('data-store-db');
        var serverStore = storeSel.getAttribute('data-store-server');

        const response = await fetch(productUniqueApiUrl + '?product_id=' + product_id + '&store_id=' + idStore +
            '&dbStore=' + dbStore + '&serverStore=' + serverStore, {
                headers: {
                    'Authorization': `Bearer ${token}`
                },
            });

        const result = await response.json();

        var modals = document.getElementById('modals');
        if (modals) {
            modals.remove();
            dataResult = '';
        }

        var modal = $('<div class="modal w-100" tabindex="-1" role="dialog" id="modals"></div>');
        var modalDialog = $('<div class="modal-dialog w-90" role="document"></div>');
        var modalContent = $('<div class="modal-content"></div>');
        var modalHeader = $(
            '<div class="modal-header"><h5 class="modal-title">Calculadora de vendas</h5><button type="button" class="close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        var modalBody = $('<div class="modal-body"></div>');

        // Create the first 3 input elements
        var cdprodutoInput = $(
            '<p class="mb-0">Custo</p><input id="prodCost" class="form-control" readonly="readonly" type="text" value="' +
            result[
                0][
                'VLRCUSTOCIMP'
            ] +
            '" />');
        if (result[0]['PROMO'] > 0) {
            var valorInput = $(
                '<p class="mb-0">Valor de Venda (Promo)</p><input class="form-control" type="text" id="prodValue" readonly="readonly" value="' +
                result[0]['VLRSUGERIDO'] +
                '" />');
        } else {
            var valorInput = $(
                '<p class="mb-0">Valor de Venda</p><input class="form-control" id="prodValue" type="text" readonly="readonly" value="' +
                result[0]['VLRSUGERIDO'] +
                '" />');
        }
        var promoInput = $(
            '<p class="mb-0">Margem Atual</p><input class="form-control" type="text" readonly="readonly" value="' +
            result[0][
                'MARGEM'
            ] +
            '" />');

        // Create the fourth input element
        var inputValue = $(
            '<p class="mb-0">Nova % de desconto</p><input class="form-control" type="number" min="0" max="100" maxlenght="5" step="0.5" placeholder="0" id="inputNewDiscount" onkeyup="recalculate();" />'
        );
        // var inputValue = $(
        //     '<p class="mb-0">Nova % de desconto</p><div class="slidecontainer"><input class="slider" id="myRange" type="range" min="0" max="100" step="0,1" value="0" oninput="this.nextElementSibling.value = this.value+\'%\'"><output>0%</output></div>'
        // );

        // Create the fifth input element
        var input5 = $(
            '<p class="mb-0">Novo Valor de Venda</p><input class="form-control" readonly="readonly" type="text" id="inputNewValue" value="' +
            result[0]['VLRSUGERIDO'] +
            '" />'
        );

        // Create the sixth input element
        var input6 = $(
            '<p class="mb-0">Nova Margem</p><input class="form-control" readonly="readonly" type="text" id="inputNewMarg" value="' +
            result[0][
                'MARGEM'
            ] +
            '"/>'
        );

        var inputData = '<p class="prodCalcName">DESCRIÇÃO: ' + result[0]['DESCRICAO'] +
            ' (' + result[0]['CDPRODUTO'] + ')</p> <span class="prodCalcCat">CATEGORIA: ' +
            result[0]['CATEGORIA'] +
            ' (LIMITE DESCONTO GERENTE: ' + result[0]['LMTDESCGERENTE'] + ')<span>';

        // Append the inputs to the modal body
        var rowData = $('<div class="row"></div>');
        var col0 = $('<div class="col-12 pb-3"></div>');
        var row1 = $('<div class="row"></div>');
        var col1 = $('<div class="col-4"></div>');
        var col2 = $('<div class="col-4"></div>');
        var col3 = $('<div class="col-4"></div>');
        var row2 = $('<div class="row pt-3"></div>');
        var col4 = $('<div class="col-4"></div>');
        var col5 = $('<div class="col-4"></div>');
        var col6 = $('<div class="col-4"></div>');
        var row3 = $('<div class="row pt-3"></div>');
        var col7 = $(
            '<div class="col-6"><button class="btn w-100 btn-success" onclick="approveDiscount(' + product_id +
            ');">Aprovar Desconto</button></div>'
        );
        var col8 = $(
            '<div class="col-6"><button class="btn w-100 btn-danger" data-bs-dismiss="modal" data-dismiss="modal">Fechar</button></div>'
        );

        col0.append(inputData);

        col1.append(cdprodutoInput);
        col2.append(valorInput);
        col3.append(promoInput);
        col4.append(inputValue);
        col5.append(input5);
        col6.append(input6);

        rowData.append(col0);
        row1.append(col1, col2, col3);
        row2.append(col4, col5, col6);
        row3.append(col7, col8);

        modalBody.append(rowData, row1, row2, row3);
        modalContent.append(modalHeader, modalBody);
        modalDialog.append(modalContent);
        modal.append(modalDialog);
        $('body').append(modal);

        // Set the focus to the fourth input
        inputValue.focus();

        modal.modal('show');
    }

    function recalculate() {
        var inputNewDiscount = document.getElementById('inputNewDiscount').value;
        var inputNewValue = document.getElementById('inputNewValue').value;
        var inputNewMarg = document.getElementById('inputNewMarg').value;
        var prodCost = document.getElementById('prodCost').value;
        var prodValue = document.getElementById('prodValue').value;

        // console.log(inputNewDiscount);
        // console.log(inputNewValue);
        // console.log(inputNewMarg);
        // console.log(prodCost);
        // console.log(prodValue);

        if (inputNewDiscount > 0) {
            var percent = inputNewDiscount / 100;
        } else {
            var percent = 0;
        }

        var newValue = prodValue - (prodValue * percent);

        var diffValue = newValue - prodCost;

        var calcNewDiff = diffValue / prodValue;

        var newMargin = calcNewDiff * 100;

        var newMargin2 = ((newValue / prodCost) * 100) - 100;

        // console.log('inputNewDiscount' + inputNewDiscount);
        // console.log('percent' + percent);
        // console.log('newValue' + newValue);
        // console.log('diffValue' + diffValue);
        // console.log('calcNewDiff' + calcNewDiff);
        // console.log('newMargin' + newMargin);
        // console.log('newMargin2' + newMargin2);

        document.getElementById("inputNewValue").setAttribute('value', newValue.toFixed(2));
        document.getElementById("inputNewMarg").setAttribute('value', newMargin2.toFixed(2));
    }

    async function approveDiscount(product_id) {
        storeSel = document.getElementById("selectedStoreData");
        var idStore = storeSel.getAttribute('data-store-id');
        var dbStore = storeSel.getAttribute('data-store-db');
        var serverStore = storeSel.getAttribute('data-store-server');
        var inputNewValue = document.getElementById('inputNewDiscount').value;
        var user_id = document.getElementById('user_id').value;

        let params = {
            'store_id': idStore,
            'dbStore': dbStore,
            'serverStore': serverStore,
            'product_value': inputNewValue,
            'product_id': product_id,
            'user_id': user_id,
        }

        let res = await fetch(saveProductApi, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify(params),
        });

        if (res.ok) {
            Swal.fire({
                icon: 'success',
                title: 'Produto Atualizado',
                text: 'Produto ' + product_id + ' com valor atualizado para: ' + inputNewValue + '%'
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Produto Não atualizado',
                text: 'Erro ao atualizar produto'
            });
        }

    }

    function makeDatatableModalProduct(result, product_id) {

    }

    function makeDatatableModal(result, data) {

        if (DataTable.isDataTable('#stock' + data + '')) {
            const table = $('#stock' + data + '').DataTable();
            table.destroy();
        }

        var modals = document.getElementById('modals');
        if (modals) {
            modals.remove();
        }

        var modal = $('<div class="modal w-100" tabindex="-1" role="dialog" id="modals"></div>');
        var modalDialog = $('<div class="modal-dialog w-90" role="document"></div>');
        var modalContent = $('<div class="modal-content"></div>');
        var modalHeader = $('<div class="modal-header"><h5 class="modal-title">Estoque das lojas do produto: ' + data +
            '</h5><button type="button" class="close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        var modalBody = $(
            '<div class="modal-body"><table class="table table-striped" id="stock' + data + '"></table></div>');

        modalContent.append(modalHeader, modalBody);
        modalDialog.append(modalContent);
        modal.append(modalDialog);
        $('body').append(modal);

        const table = $('#stock' + data + '').DataTable({
            data: result.data,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json',
            },
            searchable: true,
            columns: [{
                    data: 'LOJA',
                    title: 'LOJA'
                },
                {
                    data: 'QUANTIDADE',
                    title: 'QUANTIDADE'
                },
                {
                    data: 'GIRO',
                    title: 'GIRO'
                },
                {
                    data: 'GIRO90D',
                    title: 'GIRO90D'
                },
                {
                    data: 'GIROANUAL',
                    title: 'GIROANUAL'
                },
                {
                    data: 'ESTSEG',
                    title: 'ESTSEG'
                }
            ],
            pageLength: 200,
            aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "Todos"]
            ],
        });

        modal.modal('show');
    }

    function makeDatatableModalSupply(result, data) {

        if (DataTable.isDataTable('#supply' + data + '')) {
            const table = $('#supply' + data + '').DataTable();
            table.destroy();
        }

        var modals = document.getElementById('modals');
        if (modals) {
            modals.remove();
        }

        var modal = $('<div class="modal w-100" tabindex="-1" role="dialog" id="modals"></div>');
        var modalDialog = $('<div class="modal-dialog w-90" role="document"></div>');
        var modalContent = $('<div class="modal-content"></div>');
        var modalHeader = $('<div class="modal-header"><h5 class="modal-title">Estoque Externo: ' + data +
            '</h5><button type="button" class="close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        var modalBody = $(
            '<div class="modal-body"><table class="table table-striped" id="supply' + data + '"></table></div>');

        modalContent.append(modalHeader, modalBody);
        modalDialog.append(modalContent);
        modal.append(modalDialog);
        $('body').append(modal);


        const table = $('#supply' + data + '').DataTable({
            data: result.data,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json',
            },
            searchable: true,
            columns: [{
                    data: 'LOJA',
                    title: 'LOJA'
                },
                {
                    data: 'QUANTIDADE',
                    title: 'QUANTIDADE'
                },
                {
                    data: 'GIRO',
                    title: 'GIRO'
                },
                {
                    data: 'GIRO90D',
                    title: 'GIRO90D'
                }
            ],
            pageLength: 200,
            aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "Todos"]
            ],
        });

        modal.modal('show');
    }

    async function getLogs() {
        const response = await fetch(apiGetLogs, {
            headers: {
                'Authorization': `Bearer ${token}`
            },
        });
        const result = await response.json();
        makeLogs(result);
    }

    function makeLogs(result) {
        if (DataTable.isDataTable('#logs')) {
            const table = $('#logs').DataTable();
            table.destroy();
        }

        var modals = document.getElementById('modalLog');
        if (modals) {
            modals.remove();
        }

        var modal = $('<div class="modal w-100" tabindex="-1" role="dialog" id="modalLog"></div>');
        var modalDialog = $('<div class="modal-dialog w-90" role="document"></div>');
        var modalContent = $('<div class="modal-content"></div>');
        var modalHeader = $(
            '<div class="modal-header"><h5 class="modal-title">Logs</h5><button type="button" class="close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        var modalBody = $(
            '<div class="modal-body"><table class="table table-striped" id="logs"></table></div>');

        modalContent.append(modalHeader, modalBody);
        modalDialog.append(modalContent);
        modal.append(modalDialog);
        $('body').append(modal);

        const table = $('#logs').DataTable({
            data: result,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json',
            },
            searchable: true,
            columns: [{
                    data: 'nameStore',
                    title: 'Loja'
                },
                {
                    data: 'product_id',
                    title: 'Produto'
                },
                {
                    data: 'valorNovo',
                    title: 'Novo Desconto'
                },
                {
                    data: 'userName.name',
                    title: 'Quem aprovou'
                },
                {
                    data: 'data',
                    title: 'Quando'
                }
            ],
            pageLength: 200,
            aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "Todos"]
            ],
        });

        modal.modal('show');
    }
</script>

<style>
    .buttonsRow {
        display: none;
    }

    .dataTable {
        max-width: 100%;
        font-size: 11px;
        display: inline-table !important;
    }

    .nameProd {
        margin-top: 15px;
        max-width: 100%;
        font-size: 11px;
        display: inline-table !important;
    }

    .catProd {
        font-size: 10px;
        font-weight: bold;
        width: 100%;
        display: inline-table !important;
    }

    .dataTable th {
        font-size: 13px !important;
    }

    .dataTable thead,
    .dataTable {
        width: 100% !important;
    }

    .dataTables_wrapper {
        overflow: auto !important;
    }

    .slidecontainer {
        width: 100%;
        /* Width of the outside container */
    }

    /* The slider itself */
    .slider {
        -webkit-appearance: none;
        appearance: none;
        width: 85%;
        height: 40px;
        background: #efefef;
        outline: none;
        opacity: 0.7;
        -webkit-transition: .2s;
        transition: opacity .2s;
        border-radius: 85px;
        border: 1px solid #d3d3;
    }

    /* Mouse-over effects */
    .slider:hover {
        opacity: 1;
        /* Fully shown on mouse-over */
    }

    /* The slider handle (use -webkit- (Chrome, Opera, Safari, Edge) and -moz- (Firefox) to override default look) */
    .slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        /* Override default look */
        appearance: none;
        width: 40px;
        /* Set a specific slider handle width */
        height: 40px;
        border-radius: 40px;
        /* Slider handle height */
        background: #04AA6D;
        /* Green background */
        cursor: pointer;
        /* Cursor on hover */
    }

    .slider::-moz-range-thumb {
        width: 40px;
        /* Set a specific slider handle width */
        height: 40px;
        border-radius: 40px;
        /* Slider handle height */
        background: #04AA6D;
        /* Green background */
        cursor: pointer;
        /* Cursor on hover */
    }

    .slidecontainer output {
        z-index: 999;
        margin-top: 8px;
        font-size: 15px;
        position: absolute;
        margin-left: 5px;
    }


    ul {
        padding: 0px;
        padding-left: 0px !important;
    }

    li {
        list-style: none;
        padding: 5px;

    }

    li.selected {
        font-weight: bolder;
        background-color: #ccc;
    }

    .modal-dialog {
        max-width: 100% !important;
    }

    .prodCalcCat {
        font-size: 17px;
    }

    .prodCalcName {
        font-weight: bolder;
        font-size: 21px;
        margin-bottom: 0px;
    }
</style>

var oFilmoviModul = angular.module('movies-app', []);

oFilmoviModul.directive("navBar", function () {
    return {
        restrict: "E",
        templateUrl: "templates/navbar.php"
    };
});

// rented_movies.php

oFilmoviModul.controller('posudeniFilmovi', function ($scope, $http){
	//učitavanje posuđenih filmova
	var datum = new Date().toJSON().slice(0,10).replace(/-/g,'/');
	$scope.oPosudeniFilmovi = [];

	$http({
		method : "GET",
		url: "load.php?json_id=get_rented_movies"
	}).then(function(response) {
		$scope.oPosudeniFilmovi = response.data;
	},function (response) {
		console.log('Došlo je do pogreške.');
	});

	//vraćanje filma
	$scope.vratiFilm = function(id){
		if(confirm("Jeste li sigurni da želite vratiti film?"))  
		{  
			$http({
				method:"POST",
				url:"action/return_movie.php",
				data:
				{
					'sifra': id,
					'datum_vracanja': datum
				}
			}).then(function(response){
				{
					alert("Film uspješno vraćen!");
					location.reload();
				}
			});
		}
	}
})

oFilmoviModul.controller('zapisiPosudivanja', function ($scope, $http){
	$scope.oZapisi = [];

	$http({
		method : "GET",
		url: "load.php?json_id=get_history"
	}).then(function(response) {
		$scope.oZapisi = response.data;
	},function (response) {
		console.log('Došlo je do pogreške.');
	});
})

//users.php
oFilmoviModul.controller('sviKorisnici', function ($scope, $http){
	//učitavanje korisnika
	$scope.oKorisnici = [];

	$http({
		method : "GET",
		url: "load.php?json_id=get_all_users"
	}).then(function(response) {
		$scope.oKorisnici = response.data;
	},function (response) {
		console.log('Došlo je do pogreške.');
	});

	//brisanje korisnika
	$scope.obrisiKorisnika = function(id){  
		if(confirm("Jeste li sigurni da želite obrisati gledatelja?"))  
		{  
			$http({
				method:"POST",
				url:"action/delete_user.php",
				data:
				{
					'gledatelj_id':id
				}
			}).then(function(response){
				{
					alert(response.data);
					location.reload();
				}
			});
		}
	}

	//modal za uređivanje korisnika
	$scope.openModalEditUser = function($index){
		document.getElementById('editUser').style.display = "block";
		var id = $scope.oKorisnici[$index].gledatelj_id;
        var ime = $scope.oKorisnici[$index].ime;
		var prezime = $scope.oKorisnici[$index].prezime;

		document.getElementById('editID').value = id;
		document.getElementById('editIme').value = ime;
		document.getElementById('editPrezime').value = prezime;
	};

	$scope.closeModalEditUser = function(){
		document.getElementById('editUser').style.display = "none";
	};
	
	//uređivanje korisnika
	$scope.urediKorisnika = function(id){
		var id = document.getElementById('editID').value;
		var ime = document.getElementById('editIme').value;
		var prezime = document.getElementById('editPrezime').value;
		if (!ime || !prezime)
		{
			alert("Potrebno je popuniti sve podatke!");
		}
		else{
			$http({
				method:"POST",
				url:"action/update_user.php",
				data:
				{
					'gledatelj_id': id,
					'ime': ime,
					'prezime': prezime
				}
			}).then(function(response){
				{
					alert("Gledatelj je uspješno ažuriran!");
					location.reload();
				}
			});
		}
	};

})

//index.php

oFilmoviModul.controller('dostupniFilmovi', function ($scope, $http){
	//učitavanje dostupnih filmova
	$scope.oDostupniFilmovi = [];

	$http({
		method : "GET",
		url: "load.php?json_id=get_available_movies"
	}).then(function(response) {
		$scope.oDostupniFilmovi = response.data;
	},function (response) {
		console.log('Došlo je do pogreške.');
	});

	//modal za uređivanje
	$scope.openModalEdit = function($index){
		document.getElementById('editMovie').style.display = "block";
		var sifra = $scope.oDostupniFilmovi[$index].film_id;
        var naziv = $scope.oDostupniFilmovi[$index].naziv;
		var opis = $scope.oDostupniFilmovi[$index].opis;
		var zanr = $scope.oDostupniFilmovi[$index].zanr;

		document.getElementById('editSifra').value = sifra;
		document.getElementById('editNaziv').value = naziv;
		document.getElementById('editOpis').value = opis;
		document.getElementById('editZanr').value = zanr;
	};

	$scope.closeModalEdit = function(){
		document.getElementById('editMovie').style.display = "none";
	}

	//uređivanje
	$scope.urediFilm = function(sifra){
		var sifra = document.getElementById('editSifra').value;
		var naziv = document.getElementById('editNaziv').value;
		var opis = document.getElementById('editOpis').value;
		if (!naziv || !opis)
		{
			alert("Potrebno je popuniti sve podatke!");
		}
		else{
			$http({
				method:"POST",
				url:"action/update_movie.php",
				data:
				{
					'sifra': sifra,
					'naziv': naziv,
					'opis': opis
				}
			}).then(function(response){
				{
					alert("Film je uspješno ažuriran!");
					location.reload();
				}
			});
		}
	}

	//modal za posuđivanje
	$scope.openModalRent = function($index){
		document.getElementById('rentMovie').style.display = "block";
		var sifra = $scope.oDostupniFilmovi[$index].film_id;

		document.getElementById('rentSifra').value = sifra;
	};

	$scope.closeModalRent = function(){
		document.getElementById('rentMovie').style.display = "none";
	}
	
	//posudivanje filma
	$scope.posudiFilm = function(sifra){
		var sifra = document.getElementById('rentSifra').value;
		var gledatelj_id = OdabraniKorisnik();
		var datum = new Date().toJSON().slice(0,10).replace(/-/g,'/');
		var future = new Date();
		future.setDate(future.getDate() + 30);
		var rok = future.toJSON().slice(0,10).replace(/-/g,'/');
		if (!sifra || !gledatelj_id)
		{
			alert("Potrebno je odabrati korisnika!");
		}
		else{
			$http({
				method:"POST",
				url:"action/rent_movie.php",
				data:
				{
					'sifra': sifra,
					'gledatelj_id': gledatelj_id,
					'datum_posudivanja': datum,
					'rok': rok
				}
			}).then(function(response){
				{
					alert("Film je posuđen!");
					location.reload();
				}
			});
		}
	}

	//brisanje filma
	$scope.obrisiFilm = function(id){
		if(confirm("Jeste li sigurni da želite obrisati film?"))  
		{  
			$http({
				method:"POST",
				url:"action/delete_movie.php",
				data:
				{
					'sifra':id
				}
			}).then(function(response){
				{
					alert("Film je uspješno obrisan!");
					location.reload();
				}
			});
		}
	}
})

//statistics.php

oFilmoviModul.controller('Statistika', function ($scope, $http){
	//učitavanje top 5 filmova
	$scope.oStatistikaFilmovi = [];

	$http({
		method : "GET",
		url: "load.php?json_id=get_stats_movies"
	}).then(function(response) {
		$scope.oStatistikaFilmovi = response.data;
	},function (response) {
		console.log('Došlo je do pogreške.');
	});

	//učitavanje top 5 korirnika
	$scope.oStatistikaKorisnici = [];

	$http({
		method : "GET",
		url: "load.php?json_id=get_stats_users"
	}).then(function(response) {
		$scope.oStatistikaKorisnici = response.data;
	},function (response) {
		console.log('Došlo je do pogreške.');
	});
})

//adduser.php

oFilmoviModul.controller('dodajKorisnika', function ($scope, $http){
	//dodavanje korisnika u bazu
	$scope.dodajKorisnika = function(){
		
		oKorisnici = [];

		$http({
			method : "GET",
			url: "load.php?json_id=get_all_users"
		}).then(function(response) {
			oKorisnici = response.data;

			var pronaden = 0;
			var id = document.getElementById('addID').value;
			var ime = document.getElementById('addIme').value;
			var prezime = document.getElementById('addPrezime').value;
			for (var i = 0; i<oKorisnici.length; i++)
			{
				if (id == oKorisnici[i].gledatelj_id)
				{
					alert("Korisnik s tim ID brojem već postoji.");
					pronaden = 1;
				}
			}
			if (pronaden != 1)
			{
				if (!id || !ime || !prezime)
				{
					alert("Potrebno je popuniti sve podatke!");
				}
				else
				{
					$http({
						method:"POST",
						url:"action/add_user.php",
						data:
						{
							'gledatelj_id': id,
							'ime': ime,
							'prezime': prezime,
							'kolicina_posudivanja': 0
						}
					}).then(function(response){
						{
							alert("Gledatelj je uspješno dodan u bazu!");
							location.reload();
						}
					}); 
				}
			}

		},function (response) {
			console.log('Došlo je do pogreške.');
		});
   }  
})

//index.php - modal posuđivanje

oFilmoviModul.controller('korisnikKojiPosuduje', function ($scope, $http){
	//učitavanje korisnika iz baze u dropdown
	$scope.oKorisnici = [];

	$http({
		method : "GET",
		url: "load.php?json_id=get_all_users"
	}).then(function(response) {
		$scope.oKorisnici = response.data;
	},function (response) {
		console.log('Došlo je do pogreške.');
	});
})

//addmovie.php

oFilmoviModul.controller('dodajFilm', function($scope, $http){
	//dodavanje filma u bazu
	$scope.dodajFilm = function (){
		oFilmovi = [];

		$http({
			method : "GET",
			url: "load.php?json_id=get_all_movies"
		}).then(function(response) {
			oFilmovi = response.data;


			var pronaden = 0;
			var sifra = document.getElementById('addID-movie').value;
			var naziv = document.getElementById('addNaziv-movie').value;
			var opis = document.getElementById('addOpis-movie').value;
			var zanr = GetSelected();



			for (var i = 0; i<oFilmovi.length; i++)
			{
				if (sifra == oFilmovi[i].film_id)
				{
					alert("Film s tom šifrom već postoji.");
					pronaden = 1;
				}
			}
			if (pronaden != 1)
			{
				if (!sifra || !naziv || !opis || !zanr)
				{
					alert("Potrebno je popuniti sve podatke!");
				}
				else
				{
					$http({
						method:"POST",
						url:"action/add_movie.php",
						data:
						{
							'sifra': sifra,
							'naziv': naziv,
							'opis': opis,
							'gledatelj_id': null,
							'broj_posudivanja': 0,
							'zanr_naziv': zanr
						}
					}).then(function(response){
						{
							alert("Film je uspješno dodan u bazu!");
							location.reload();
						}
					});
				}
			}

		},function (response) {
			console.log('Došlo je do pogreške.');
		});
	}
})

function GetSelected() {
	//Create an Array.
	var selected = new Array();

	//Reference the Table.
	var forma = document.getElementById("zanr_array_id");

	//Reference all the CheckBoxes in Form.
	var chks = forma.getElementsByClassName("izbor");

	// Loop and push the checked CheckBox value in Array.
	for (var i = 0; i < chks.length; i++) {
		if (chks[i].checked) {
			selected.push(chks[i].value);
		}
	}

	var x = selected.toString();
	return x;

	//Display the selected CheckBox values.
	/*if (selected.length > 0) {
		alert("Selected values: " + selected.join(", "));
	}*/
};

function OdabraniKorisnik(){
	var select = document.getElementById("odabrani-korisnik").value;
	return select;
}
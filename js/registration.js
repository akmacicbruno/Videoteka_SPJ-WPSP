var oRegModul = angular.module('reg-app', []);

oRegModul.controller('administracija', function($scope, $http)
{
    $scope.openModalRegUser = function($index){
		document.getElementById('registerUser').style.display = "block";
	};

	$scope.closeModalRegUser = function(){
		document.getElementById('registerUser').style.display = "none";
	};

    $scope.regUser = function(){
        oAdmins = [];

        $http({
			method : "GET",
			url: "load.php?json_id=get_admins"
		}).then(function(response){
            oAdmins = response.data;

            var pronaden = 0;
            var username = document.getElementById('regUsername').value;
            var pass1 = document.getElementById('regPass').value;
            var pass2 = document.getElementById('regPass2').value;
            for (var i = 0; i<oAdmins.length; i++)
			{
				if (username == oAdmins[i].username)
				{
					alert("Admin s tim korisničkim imenom već postoji.");
					pronaden = 1;
				}
			}
            if (pronaden != 1)
            {
                if (username || pass1 || pass2)
                {
                    if (pass1 != pass2)
                    {
                        alert("Lozinke se ne podudaraju!");
                    }
                    else{
                        $http({
                            method:"POST",
                            url:"action/add_admin.php",
                            data:
                            {
                                'username': username,
                                'pass1': pass1
                            }
                        }).then(function(response){
                            {
                                alert("Admin uspješno dodan!");
                                window.location.replace("login.php");
                            }
                        });
                    }
                }
                else{
                    alert("Potrebno je popuniti sve podatke!");
                }
            }
        },function (response) {
			console.log('Došlo je do pogreške.');
		});
	}
})
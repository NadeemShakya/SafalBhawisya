let li0 = [
{	Name: 'li0'},
{
	ChildCount: 11
},
{	Child: [
			[
				{Name: '+2(HSEB)'},
				{ChildCount:3},
				{Child: [
							[
								{Name:'Science'},
								{ChildCount:0},
									
							],
							[
								 {Name:'Commerce & Management'},
								 {ChildCount:0},
							],
							[
								{Name:'Humanities'},
								{ChildCount:0}
							]

						]
				},
				{status:false}
			],
			[
				{Name: 'A Level'},
				{ChildCount:0},
			],
			[
				{Name:'International Baccalaureate'},
				{ChildCount:0}
			],
			[
				{Name:'Law'},
				{ChildCount:0}
			],
			[
				{Name:'Education'},
				{ChildCount:0}	
			],
			[
				{Name:'Forestry'},
				{ChildCount:0}
			],
			[
				{Name:'Agriculture & Vetenary'},
				{ChildCount:0}
			],
			[
				{Name:'Hospitality Management'},
				{ChildCount:0}
			],
			[
				{Name:'Fashion Designing'},
				{ChildCount:0}
			],
			[
				{Name:'Fine Arts'},
				{ChildCount:0}
			],
			[
				{Name:'Vocational Courses'},
				{ChildCount:0}
			]

		]
},
{
	status:false
}
];



let li0ID = document.getElementById('li0ID');
li0ID.addEventListener('click', function() {

	showChild(li0);
});

 function showChild(root){
 	if(root[1].ChildCount != 0 && !root[1].status){
 		root[1].status = true;
		let newDiv = document.createElement('DIV');
		newDiv.className = "ulDiv";
		let newul = document.createElement('UL');
		newDiv.appendChild(newul);
		document.body.appendChild(newDiv);
		for(let i = 0; i < root[1].ChildCount; i++) {
			let newli = document.createElement('LI');
			newli.id = 'li'+[i+1];
			newli.addEventListener('click', function() {
				showChild(root[2].Child[i]);
			});
			let text = document.createTextNode(root[2].Child[i][0].Name);
			newli.appendChild(text);
			newul.appendChild(newli);


		}
	}
}


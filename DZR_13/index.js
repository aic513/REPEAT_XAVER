console.log('Ex �1');
var name = 'Denis ';
var age = 26;
console.log('My name is ' + name + 'I am ' + age + 'years old');
delete name,age;
name = age = undefined;


console.log('Ex �2');
const my_city = 'Kaluga';
 if (typeof my_city !=="undefined"){
    console.log('My hometown is ' +my_city);
 }
 const my_city = 'SPB';
 
console.log('Ex �3');
var array = {'title': '������������ � ���������',
             'author': '�����������',
    'pages': '569'};
console.log(array);
console.log('������� � �������� ����� - ' + array['title'] +
        ',���������� ������� - ' + array['author'] +
        '. � ������ ��� ' + array['pages'] + ' �������');

console.log('Ex �4');


var book1 = {'title_1':'"\������������ � ���������\"',
             'author_1':'�.�.�����������',
             'pages_1':'863'
};

var book2 = {'title_2':'"\���� � ����\"',
             'author_2':'�.�.����������',
             'pages_2':'567'};

var books = {0: book1, 1: book2};

var sum_pages = books['0']['pages_1']+books['1']['pages_2']; 

console.log('������� � �������� ����� ' + books[0]['title_1'] 
            + ' � ' + books[1]['title_2']
            + ', ���������� �������������� �������� '
            + books[0]['author_1'] + ' � ' + books[1]['author_2']
            + ', � ������ � ����� ' 
            + sum_pages + ' �������, �� ������ �� ���� ���������.');





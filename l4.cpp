#include <iostream>
#include <string>
#include <math.h>
#include <vector>
#include <cstdlib>
#include <fstream>

using namespace std;

string removeSpaces(string str) {
    int i = 0, j = 0;
    int l = str.length();
    while (str[i])
    {
        if (str[i] != ' '){
           str[j++] = str[i];
        } else {
           l--;
        }
        i++;
    }
    str[j] = '\0';
    str.resize (l);
    return str;
}

int main(int argc, char* argv[]) {
    int l;
    cout << "Insert number of cryptograms: ";
    cin >> l;
    string s;
    getline(cin, s);

    string* c = new string[l];

    int maxlen = 0;

    for(int i = 0; i < l; i++) {
        cout << "Insert cryptogram #" << i + 1 << ": ";
        getline(cin, c[i]);
        c[i] = removeSpaces(c[i]);
        if(c[i].length() > maxlen) maxlen = c[i].length();
    }

    int d = (maxlen) / 8;
    int A[l][d];
    for(int i = 0; i < l; i++){
        for(int j = 0; j < d; j++){
            A[i][j] = 0;
        }
    }

    int b[8];
    for(int i = 0; i < l - 1; i++){
        for(int j = i + 1; j < l; j++){
            int len = (min(c[i].length(), c[j].length())) / 8;
            for(int k = 0; k < len; k++){
                for(int bit = 0; bit < 8; bit++){
                    if(c[i][k * 8 + bit] == c[j][k * 8 + bit]){
                        b[bit] = 0;
                    } else {
                        b[bit] = 1;
                    }
                }
                if(b[0] == 0 && b[1] == 1){
                    A[i][k]++;
                    A[j][k]++;
                }
            }
        }
    }

    int lm = 0;
    char k[d][8];
    char mm[d][8];

    for(int i = 0; i < d; i++){
        for(int j = 0; j < l; j++){
            if(A[j][i] > A[lm][i]){
                lm = j;
            }
        }
        for(int bit = 0; bit < 8; bit++){
            mm[i][bit] = c[lm][i * 8 + bit];
        }
    }

    for(int i = 0; i < d; i++){
        for(int bit = 0; bit < 8; bit++){
            if(bit == 2){
                if(mm[i][bit] == '1'){
                    k[i][bit] = '0';
                } else {
                    k[i][bit] = '1';
                }
            } else {
                if(mm[i][bit] == '0'){
                    k[i][bit] = '0';
                } else {
                    k[i][bit] = '1';
                }
            }
        }
    }

    cout << "Message to decipher: ";
    string msg;
    getline(cin, msg);
    msg = removeSpaces(msg);

    ofstream myfile;
    myfile.open ("resbin.txt");
    for(int i = 0; i < min(d, (int)(msg.length() / 8)); i++){
        for(int bit = 0; bit < 8; bit++){
            if(k[i][bit] == msg[i * 8 + bit]){
                b[bit] = 0;
            } else {
                b[bit] = 1;
            }
            myfile << b[bit];
        }
        myfile << " ";
        int multiplier = 1;
        int res = 0;
        for (int j = 7; j >= 0; --j ){
            res += (multiplier * b[j]);
            multiplier *= 2;
        }
        char cs = res;
        cout << cs;

    }
    myfile.close();

    return 0;
}
